<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WorldLottoCheck    extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'world:check2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks if end_date has been hit';

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
        $now = date('Y-m-d H:i:s');
        $worldLottos = \App\Models\TheWorldLottery::TheWorldLotteryFunction($now);
        var_dump($worldLottos);
        if(isset($worldLottos[0]->id)){
            var_dump('hello');
            \App\Models\TheWorldLottery::TheWorldLotteryWin($worldLottos[0]->id);
        }                 
    }
}
