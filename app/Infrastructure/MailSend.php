<?php

namespace App\Infrastructure;

use Illuminate\Support\Facades\Mail;

//use Image;

class MailSend
{
//    public static function  getMailInfo() {
//        return [
//        'appName' => 'My Invoice',
//        'helpUrl' => '#',
//        'logo' => Media::getMailImage('logo.png'),
//    ];
//    }
    public static function sendLoanApprovedMail($mailData){

//        dd($mailData['attachments']['email']);
        if(empty($mailData['attachments']['email'])) {
            return;
        }
        $data = [
            'to_email' => $mailData['attachments']['email'],
            'email_subject' => 'Loan Approved',
//            'mailInfo' => self::getMailInfo(),
            'pdfAgreement' => $mailData['attachments']['pdfAgreement'],
            'pdfSanctionLetter' => $mailData['attachments']['pdfSanctionLetter'],
            'pdfGstInvoice' => $mailData['attachments']['pdfGstInvoice'],

        ];
//        dd($data);
        //Send mail

        Mail::send('emails/loan-approved', $data, function ($message) use ($data){
            $message->to($data['to_email']);
            $message->replyTo(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'));
            $message->subject(env('APP_NAME') . ' - ' . $data['email_subject']);
            $message->attachData($data['pdfAgreement']['pdf'], $data['pdfAgreement']['name']);
            $message->attachData($data['pdfSanctionLetter']['pdf'], $data['pdfSanctionLetter']['name']);
            $message->attachData($data['pdfGstInvoice']['pdf'], $data['pdfGstInvoice']['name']);
        });

    }

}
