<!DOCTYPE html>
<html>
   <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Legalario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body style="margin: 0; padding: 0;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
      <tr>
        <td align="right" bgcolor="#131313" style="padding: 8px 5px 5px 5px;">
          <!-- <a href="https://www.facebook.com/GpoSeguritech"><img style="padding: 0px 7px 0px 0px;" src="https://www.legalario.com/images/mailing/legalario-facebook.png"></a> <a href="https://twitter.com/SeguritechGrupo?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><img style="padding: 0px 12px 0px 0px;" src="https://www.legalario.com/images/mailing/legalario-twitter.png"></a> -->
        </td>
      </tr>
      <tr>
        <td align="center" bgcolor="#131313" style="padding: 5px 40px 30px 40px;">
          <!-- <img src="https://ciberseguridad-cms.webdecero.dev/CMS-WDC/uploads/assets/img/seguritechLogoBlanco.png" alt="Image" style="display: block;" /> -->
        </td>
      </tr>
      <tr>
        <td bgcolor="#eaeef4" style="padding: 80px 40px 100px 40px;">
          <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td style="color: #6e6d71; font-family: Arial, sans-serif;"><strong style="font-size: 17px;"> Hola,</strong>
                    <p style="margin: 0px 0px 5px 0px; font-size: 15px;">Alguien desea contactar con <strong>Seguritech</strong>.</p><br>
                </td>
            </tr>
            <tr>
                <td style="color: #6e6d71; font-family: Arial, sans-serif;">
                    <p style="margin: 0px 0px 5px 0px; font-size: 15px;"><u>Datos de contacto</u></p>
                    <p> <strong>Nombre:</strong> {{$contact->name}} @if($contact->last_name != null)
                      {{$contact->last_name}}
                    @endif</p>
                    @if($contact->phone != null)
                        <p><strong>Telefono:</strong> {{$contact->phone}}</p>
                    @endif
                    <p> <strong>Correo:</strong> {{$contact->email}} </p>
                    <p> <strong>Mensaje:</strong> {{$contact->message}}</p>
                </td>
            </tr>
            <tr>
              <td style="height: 50px;"></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td bgcolor="#131313">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td align="center" style="padding: 20px 30px 20px 30px; font-family: Arial, sans-serif;">
                <p style="font-size:13px; color: #ffffff; padding: 0; margin: 0;"><!-- Seguritech © --> {{ date ('Y') }} - Todos los derechos reservados.</p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>
