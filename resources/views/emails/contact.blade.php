<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message de Contact</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
<table cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <tr>
        <td style="padding: 40px 30px; text-align: center; background-color: #4F46E5; border-radius: 8px 8px 0 0;">
            <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 600;">Confirmation Rendez-vous ! </h1>
        </td>
    </tr>
    <tr>
        <td style="padding: 30px;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="padding: 10px 0;">
                        <p style="margin: 0; font-size: 16px; line-height: 24px; color: #374151;">
                            <strong style="color: #111827;">Nom :</strong>
                            <span style="margin-left: 8px;">{{ $details['name'] }}</span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;">
                        <p style="margin: 0; font-size: 16px; line-height: 24px; color: #374151;">
                            <strong style="color: #111827;">Email :</strong>
                            <span style="margin-left: 8px;">{{ $details['email'] }}</span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;">
                        <p style="margin: 0; font-size: 16px; line-height: 24px; color: #374151;">
                            <strong style="color: #111827;">Message :</strong>
                        </p>
                        <div style="margin-top: 8px; padding: 15px; background-color: #f9fafb; border-radius: 6px; border: 1px solid #e5e7eb;">
                            <p style="margin: 0; font-size: 16px; line-height: 24px; color: #374151;">
                                {{ $details['message'] }}
                            </p>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding: 20px 30px; text-align: center; background-color: #f9fafb; border-radius: 0 0 8px 8px;">
            <p style="margin: 0; font-size: 14px; color: #6b7280;">
                Ce message a été envoyé via le formulaire de prise de rendez-vous.
            </p>
        </td>
    </tr>
</table>
</body>
</html>
