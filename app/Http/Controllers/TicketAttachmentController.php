<?php

namespace App\Http\Controllers;

use App\Models\TicketAttachment;

class TicketAttachmentController extends Controller
{
    /**
     * Download a ticket attachment from storage.
     */
    final public function download(TicketAttachment $attachment): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return \response()->download(\getcwd().'/files/attachments/attachments/'.$attachment->file_name)->deleteFileAfterSend(false);
    }
}
