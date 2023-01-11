<?php

namespace Webdecero\Webcms\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

use Webdecero\Webcms\Models\Admin;
use Webdecero\Webcms\Controllers\Settings\SettingsController;
use Webdecero\Webcms\Controllers\Site\SiteController;

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
        if (!Schema::hasTable('webcms_sites')) {
            $this->info("Creating webcms_sites collection");
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
            $createSite = $webcms_sites->createSite($answers['name'], $answers['keyName'], $answers['urlBase']);
            if($createSite){
                $this->info("webcms_sites collection created successfully!!");
                $this->newLine();
            }
        }
        if (!Schema::hasTable('webcms_settings')) {
            $this->info("Creating webcms_settings collection");
            $webcms_settings = new SettingsController();
            $createSettings = $webcms_settings->createSettings();
            if($createSettings){
                $this->info("webcms_settings collection created successfully!!");
                $this->newLine();
            }
        }

        /*TODO */
        //create page and template default

        if (!Schema::hasTable('webcms_admin')) {
            $this->info("Creating a new user admin");
            $this->call('webcms:admin');
        }

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