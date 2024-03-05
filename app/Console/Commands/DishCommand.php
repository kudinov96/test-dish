<?php

namespace App\Console\Commands;

use App\Services\DishService;
use Illuminate\Console\Command;

class DishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dish {dishCode}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Получить варианты блюда';

    /**
     * Execute the console command.
     */
    public function handle(DishService $dishService)
    {
        $dishCode = $this->argument("dishCode");

        $this->info($dishCode);

        try {
            $result = $dishService->variableDishesByCode($dishCode);
        } catch (\LogicException $exception) {
            $this->error($exception->getMessage());
            return;
        }

        dump($result);

        $this->info($result->toJson());
    }
}
