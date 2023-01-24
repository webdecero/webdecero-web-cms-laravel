<?php

namespace Webdecero\Webcms\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

use Webdecero\Webcms\Models\Admin;
use Webdecero\Webcms\Models\Site\Seo;
use Webdecero\Webcms\Schemas\SeoSchema;
use Webdecero\Webcms\Schemas\SettingsSchema;
use Webdecero\Webcms\Schemas\IdentitySchema;
use Webdecero\Webcms\Schemas\FrontEndFilesSchema;
use Webdecero\Webcms\Controllers\Site\SiteController;
use Webdecero\Webcms\Controllers\Settings\SettingsController;
use Webdecero\Webcms\Controllers\Pages\PagesController;
use Webdecero\Webcms\Controllers\Templates\TemplatesController;

class SetupInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webcms:install';
    protected $host = '';

    protected $ask =
    [
        'name' => [
            'ask' => 'What is the name of your site?',
            'rule' => 'required|max:255|min:3'
        ],
        'keyName' =>  [
            'ask' => 'Enter a keyname for your site:',
            'rule' => 'required|max:255|min:3|alpha_dash|regex:/^[A-Za-z0-9_-]+$/m'
        ],
        /*'urlBase' => [
            'ask' => "Do you want to use this base url for your site [$host]? Press enter if yes or if not enter the new base url",
            'rule' => 'sometimes|max:25|min:6|url'
        ]*/
    ];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run to setup Webcms';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->host = url('/');
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        //run command public disk webcms
        $this->newLine();
        $this->info("Creating public links...");
        $this->newLine();
        $this->call('storage:link');

        //run command passport
        $this->newLine();
        $this->info("Installing passport...");
        $this->newLine();
        $this->call('passport:install');
        $this->newLine();

        if (!Schema::hasTable('webcms_sites')) {
            $this->info("Creating site");
            $answers = [];
            foreach ($this->ask as $key => $ask) {
                $answers[$key] =  $this->createAsk($key, $ask);
            }
            $answers['urlBase'] = $this->anticipate("Do you want to use this base url for your site [$this->host]? Press enter if yes or if not enter the new base url",
                 [$this->host]);

            if(empty($answers['urlBase'])) $answers['urlBase'] = $this->host;

            $this->info("{$answers['urlBase']} is done.");
            $this->newLine();
            $webcms_sites = new SiteController();

            $seo = new Seo();
            $seo->es = new SeoSchema('title', 'description', [], 'image', 'schema');
            $settings = new SettingsSchema($answers['name'], $answers['urlBase'], 'es', 'robots', 'pathFavicon');
            $css = new FrontEndFilesSchema([],'', '');
            $javaScript = new FrontEndFilesSchema([],'', '');

            $createSite = $webcms_sites->createSite($answers['keyName'], $seo, $settings, $css, $javaScript);
            if($createSite){
                $this->info("Site created successfully!!");
                $this->newLine();
            }
        }
        if (!Schema::hasTable('webcms_settings')) {
            $this->info("Creating webcms_settings collection");
            $webcms_settings = new SettingsController();
            
            $sideBar = new IdentitySchema('storage-webcms/manager/logos/logoWDCSidebar.png', '#304156');
            $login = new IdentitySchema('storage-webcms/manager/logos/logoWDCLogin.png', '#2D3A4B');

            $createSettings = $webcms_settings->createSettings($sideBar, $login);
            if($createSettings){
                $this->info("webcms_settings collection created successfully!!");
                $this->newLine();
            }
        }

        if (!Schema::hasTable('webcms_pages')) {
            $this->info("Creating webcms_pages collection");
            $webcms_pages = new PagesController();

            $seo = new SeoSchema('', '', [], '', '');
            $css = new FrontEndFilesSchema([],'', '');
            $javaScript = new FrontEndFilesSchema([],'', '');

            $createPage = $webcms_pages->createPage($seo, $css, $javaScript);
            if($createPage){
                $this->info("webcms_pages collection created successfully!!");
                $this->newLine();
            }
        }

        if (!Schema::hasTable('webcms_templates')) {
            $this->info("Creating webcms_templates collection");
            $webcms_templates = new TemplatesController();

            $css = new FrontEndFilesSchema([],'', '');
            $javaScript = new FrontEndFilesSchema([],'', '');

            $createTemplates = $webcms_templates->createTemplates($css, $javaScript);
            if($createTemplates){
                $this->info("webcms_templates collection created successfully!!");
                $this->newLine();
            }
        }

        if (!Schema::hasTable('webcms_admin')) {
            $this->info("Creating a new user admin");
            $this->call('webcms:admin');
        }

        $this->newLine();
        $this->newLine();
        $this->info("¡¡Installation done successfully!!");

    }

    public function createAsk($key, $ask)
    {
        do {
            $input[$key] = $this->ask($ask['ask']);
            $rule[$key] = $ask['rule'];

            $validator = Validator::make($input, $rule);

            if ($validator->fails()) {
                $error = $validator->errors()->first($key);
                $this->error($error);
            } else {
                $this->info("{$input[$key]} is done.");
            }
        } while ($validator->fails());

        return $input[$key];
    }
}