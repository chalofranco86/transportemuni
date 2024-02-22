<?php

namespace App\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Card;

class GeneratePDFJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $card;

    /**
     * Create a new job instance.
     *
     * @param Card $card
     */
    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $pdf = PDF::loadView('report.reportcard', ['card' => $this->card]);
            $pdfContent = $pdf->output();

            // Save the PDF to storage or any other desired location
            $path = 'pdf/' . $this->card->id . '_report.pdf';
            Storage::put($path, $pdfContent);

            // You might want to update the card model with the path or status, etc.
            $this->card->update(['pdf_path' => $path]);

        } catch (\Exception $e) {
            // Handle the exception, log, or report it as needed
            \Log::error('PDF generation error: ' . $e->getMessage());
        }
    }
}
