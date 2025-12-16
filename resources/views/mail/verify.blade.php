<!DOCTYPE html>
<html>
<head>
    <title>Verificação de E-mail</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" cellpadding="20" cellspacing="0" style="background-color: #ffffff; margin-top: 40px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                    <tr>
                        <td>
                            <h2 style="color: #333333; text-align: center;">Verificação de E-mail</h2>
                            <p style="color: #555555; font-size: 16px;">Olá <strong>{{ $user->name }}</strong>,</p>
                            <p style="color: #555555; font-size: 16px;">Clique no botão abaixo para verificar seu e-mail:</p>
                            <p style="text-align: center;">
                                <a href="{{ $link }}" style="display: inline-block; padding: 12px 24px; background-color: #3490dc; color: #ffffff; text-decoration: none; border-radius: 4px; font-weight: bold;">Verificar E-mail</a>
                            </p>
                            <p style="color: #999999; font-size: 14px; text-align: center;">Se você não solicitou este e-mail, ignore esta mensagem.</p>
                            <p style="color: #555555; font-size: 16px;">Obrigado!<br>Equipe</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
