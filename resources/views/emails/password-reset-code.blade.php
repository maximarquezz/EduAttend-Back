<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview - Recuperación de Contraseña - EduAttend</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f7fa;
            padding: 20px;
            line-height: 1.6;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .header {
            background: #3b82f6;
            padding: 25px 30px;
            text-align: center;
            color: white;
        }
        
        .header h1 {
            font-size: 28px;
            margin: 0;
            font-weight: 700;
        }
        
        .content {
            padding: 40px 30px;
        }
        
        .greeting {
            font-size: 18px;
            color: #1f2937;
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .message {
            font-size: 15px;
            color: #4b5563;
            margin-bottom: 30px;
            line-height: 1.7;
        }
        
        .code-container {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border: 2px dashed #3b82f6;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            margin: 30px 0;
        }
        
        .code-label {
            font-size: 13px;
            color: #1e40af;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }
        
        .code {
            font-size: 36px;
            font-weight: 700;
            color: #1e40af;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
            margin: 10px 0;
        }
        
        .code-hint {
            font-size: 12px;
            color: #6b7280;
            margin-top: 12px;
        }
        
        .warning {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 25px 0;
            border-radius: 4px;
        }
        
        .warning p {
            font-size: 14px;
            color: #92400e;
            margin: 0;
        }
        
        .footer {
            background-color: #f9fafb;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        
        .footer p {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 8px;
        }
        
        .footer .brand {
            font-weight: 600;
            color: #1e40af;
        }
        
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #e5e7eb, transparent);
            margin: 25px 0;
        }
        
        @media only screen and (max-width: 600px) {
            .email-container {
                border-radius: 0;
            }
            
            .header {
                padding: 20px;
            }
            
            .header h1 {
                font-size: 24px;
            }
            
            .content {
                padding: 30px 20px;
            }
            
            .code {
                font-size: 28px;
                letter-spacing: 6px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>EduAttend</h1>
        </div>
        
        <!-- Content -->
        <div class="content">
            <div class="greeting">¡Hola!</div>
            
            <div class="message">
                Hemos recibido una solicitud para restablecer la contraseña de tu cuenta en EduAttend. 
                Utiliza el siguiente código de verificación para continuar con el proceso:
            </div>
            
            <!-- Code Box -->
            <div class="code-container">
                <div class="code-label">Tu código de verificación</div>
                <div class="code">AB7392</div>
                <div class="code-hint">Ingresa este código en la aplicación</div>
            </div>
            
            <!-- Warning -->
            <div class="warning">
                <p>⚠️ <strong>Importante:</strong> Este código expirará pronto. Si no solicitaste este cambio, ignora este mensaje y tu contraseña permanecerá sin cambios.</p>
            </div>
            
            <div class="divider"></div>
            
            <div class="message">
                Si tienes algún problema o pregunta, no dudes en contactar con el soporte técnico de tu institución.
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p>Este es un correo electrónico automático, por favor no respondas a este mensaje.</p>
            <p class="brand">EduAttend © 2025</p>
        </div>
    </div>
</body>
</html>