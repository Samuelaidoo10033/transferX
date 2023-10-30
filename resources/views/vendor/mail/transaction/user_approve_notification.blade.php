<!DOCTYPE html>
<html>
<head>
    <title>Email Template</title>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif; font-size: 14px; line-height: 1.4; color: #333333;">
    <tbody>
    <tr>
        <td style="padding: 20px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #ffffff; border-radius: 4px;">
                <tbody>
                <tr>
                    <td style="padding: 20px;">
                        <img src="{{asset('images/tranzielogo.svg')}}" alt="Logo" style="display: block; margin: 0 auto; max-width: 200px; align-content: center">
                        <br>
                        <p>Hello!</p>
                        <br>
                        <p>We are pleased to inform you that your transaction with reference {{ $transaction->reference }}  has been approved and processed successfully. </p>

                        <ul>
                            <li><strong>Amount:</strong> {{$transaction->from}}  {{$transaction->amount}}</li>
                            <li><strong>Amount To Send:</strong> {{$transaction->to}} {{ $transaction->amount * $transaction->rate}}</li>
                            <li><strong>Recipient Name:</strong> {{ $transaction->recipient_name }} </li>
                            <li><strong>Recipient Bank:</strong> {{ $transaction->recipient_provider }} </li>
                            <li><strong>Recipient Account Number:</strong> {{ $transaction->recipient_number }} </li>
                            <li><strong>Reference:</strong> {{ $transaction->reference }} </li>
                            <li><strong>Time of Transaction:</strong> {{ $transaction->updated_at->format('Y-m-d H:i:s') }}</li>
                        </ul>
                        <p>If you have any questions or require further assistance, please feel free to contact our support team.
                        </p>
                        <br>
                        <p>Regards,</p>
                        <p>Tranzie</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
