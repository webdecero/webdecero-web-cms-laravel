<?php

namespace Webdecero\Webcms\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

use Webdecero\Webcms\Models\Admin;

class SetupAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webcms:admin';

    protected $ask =
    [
        'name' => [
            'ask' => 'What is your name?',
            'rule' => 'required|max:255|min:3'
        ],
        'email' =>  [
            'ask' => 'What is your email?',
            'rule' => 'required|email|max:255|unique:Admin,email'
        ],
        'password' => [
            'ask' => 'What is your password?',
            'rule' => 'required|max:25|min:6'
        ]
    ];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add admin user WebdeceroCMS';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $admin = new Admin;
        foreach ($this->ask as $key => $ask) {
            $admin->{$key} =  $this->createAsk($key, $ask);
        }
        $token = $admin->createToken('Laravel Password Grant Client WEBCMS')->accessToken;
        $admin->status =  true;
        $admin->save();

        $this->info("Token: {$token}");
        // $loginRoute = "Panel ".route('manager.index');

        // $this->info($loginRoute);
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
                // $errors = $validator->errors()->get($key);
                // foreach ($errors as $key => $error) {
                //     $this->error($error);
                // }
            } else {
                $this->info("{$input[$key]} is done.");
            }
        } while ($validator->fails());

        return $input[$key];
    }
}