<?php

namespace App\Console\Commands;

use App\Modules\Admin\Product\Models\Product;
use Illuminate\Console\Command;

class UpdateSlugCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-slug-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = Product::all();
        foreach ($data as $product) {
            $product->slug = generateSlug($product->name).$product->id;
            $product->save();
        }
    }
}
