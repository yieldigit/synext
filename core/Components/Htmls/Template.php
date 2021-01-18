<?php

namespace Synext\Components\Htmls;

class HtmlTemplate
{
    /**
     * return  html Mail template !
     *
     * @param string $doamine
     * @param string $logo
     * @param string $message [html content]
     *
     * @return string
     */
    public static function htmlMailReset(string $domaine,string $logo, string $message) : string
    {   $date = date('Y');
        return <<<HTML
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTDxhtml1-transitional.dtd"> <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                </head>
                <body>
                    <table width="660" cellpadding="0" cellspacing="0" style="text-align:center; background-color:#fff;border:none" style="border-radius:6px">
                        <tbody>
                            <tr>
                                <td style="padding:30px 30px 30px 30px;border-radius:5px">
                                    <table width="600" cellpadding="0" style="text-align:center; background-color:#fff;border:none" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td  style="text-align:left;font-size:14px;font-family:Helvetica,Arial,sans-serif;line-height:25px;color:#445566" >

                                                    <img src="{$logo}" width=50 alt="{$domaine}" style="margin:0;padding:0;max-width:600px;border:none;font-size:14px;font-weight:bold;min-height:auto;line-height:100%;outline:none;text-decoration:none;text-transform:capitalize">
                                                    <p style="margin-top:5px;margin-bottom:20px">
                                                        {$message}
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table width="600" cellpadding="0" style="text-align:center; background-color:#fff;border:none" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td height="30" style="border-top:1px solid #dddddd"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </body>
            </html>
HTML;
    }

}
