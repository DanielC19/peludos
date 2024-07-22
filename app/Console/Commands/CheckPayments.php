<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CheckPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check payment status in Wompi to update on DB';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orders = Order::where('state', 'PENDING')->get();

        $wompi_private_key = env('WOMPI_PRIVATE_KEY');

        foreach ($orders as $order) {
            // Search each payment in Wompi
            $wompi_response = Http::withToken($wompi_private_key)->get("https://sandbox.wompi.co/v1/transactions/$order->transaction_id");
            $wompi_response = $wompi_response->object();
            // Update status
            $order->state = $wompi_response->data->status;
            $order->save();
        }

        $this->info('Orders updated :D');
    }
}
