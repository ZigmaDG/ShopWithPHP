<?php
session_start();
include 'header.php';
include 'header2.php';
require_once 'conexion.php';
$i=0;

unset($_SESSION['Confirm']);
unset($_SESSION['info_envio']);
unset($_SESSION['ent_personal']);
unset($_SESSION['pago']);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <LINK REL=StyleSheet HREF="CSS/Estilos_principal.css" TYPE="text/css">
    <title>Terminos y condiciones</title>
</head>
<body>
    <div class="container">

    <p>Toda tienda online debe exponer sus Condiciones de Uso.
Aquí las tienes una a una. Si tienes alguna duda, nuestro Servicio de Atención al Cliente se pone a tu servicio telefónicamente o via mail.
</p>

<h1>POLÍTICAS APLICABLES A CUALQUIER VENTA ACEPTO TÉRMINOS Y CONDICIONES</h1>
<p>
  <ul>
      <li><b>1. General</b> La utilización de esta página web supone la aceptación de las Condiciones de Uso aquí expuestas.</li>
      <li><b>2. Propiedad de esta página web</b> Regalo del Corazón o Heart Gift, es propietaria de esta página web, así como de todos los derechos de su contenido, de las imágenes, textos, diseño y software. Todos los elementos de esta página, su diseño y su contenido están protegidos, sin limitación alguna, por las leyes de Propiedad Intelectual, Propiedad Industrial y Tratados Internacionales relativos a los Derechos de Autor.</li>      
      <li><b>3. Uso de su contenido</b> Queda terminantemente prohibido cualquier acto de reproducción, transmisión, distribución, almacenamiento, explotación o comunicación pública o parcial del contenido de esta web, salvo consentimiento expreso de Regalo del Corazón o Heart Gift.</li>
      <li><b>4. Responsabilidades</b>
            <ul>
                <li>4.1. Regalo del Corazón o Heart Gift, intentará garantizar la precisión y la exactitud del contenido de esta página web; no obstante, ésta puede contener errores e inexactitudes. Es por ello que, a pesar de nuestro esfuerzo, no asumimos ninguna responsabilidad derivada de la falta de veracidad, integridad, actualización y precisión de los datos o informaciones que se contienen en nuestra página web.</li>
                <li>4.2. La página web www.regalodelcorazon.com, puede contener diversos enlaces (links) a otras páginas de terceros. Por lo tanto, Regalo del Corazón o Heart Gift no se hace responsable por el contenido que contengan o llegasen a contener las páginas webs de terceros.</li>
                <li>4.3. Regalo del Corazón o Heart Gift, no se responsabiliza de los daños o perjuicios que pudieran derivarse del uso incorrecto, inapropiado o ilícito de la información aparecida en esta página web.</li>
                <li>4.4. El usuario responde de la veracidad de los datos ofrecidos a Regalo del Corazón o Heart Gift, siendo responsable de los perjuicios que la falta de autenticidad ocasione.</li>
                <li>4.5. El usuario declara ser mayor de edad.</li>
                <li>4.6. Regalo del Corazón o Heart Gift, no garantiza la disponibilidad ni el stock de todos los productos anunciados, por lo que queda reservado el derecho a anular la compra procediendo a la devolución del importe.</li>
                <li>4.7. Toda compra cursada y confirmada por Internet ha de ser aceptada después de haber sido enviada y pagada.</li>
                <li>4.8. Regalo del Corazón o Heart Gift, se reserva el derecho de entregar los productos solicitados. </li>
            
            </ul>
        </li>
      <li><b>5. Divisibilidad</b> Si alguna estipulación de las presentes condiciones careciese o pasase a carecer de validez o no fuese ejecutable según el Derecho aplicable, la misma no surtirá efecto pero no afectará a la validez y aplicabilidad de las restantes estipulaciones contenidas en las presentes condiciones.</li>
      <li><b>6. Legislación y jurisdicción aplicable</b> Estas Condiciones Generales se rigen por la ley Mexicana. Las partes se someten, a su elección, para la resolución de los conflictos y con renuncia a cualquier otro fuera a los juzgados y tribunales del domicilio del usuario.</li>
      <li><b>7.Modificaciones</b> Regalo del Corazón o Heart Gift, se reserva el derecho a revisar y modificar las presentes Condiciones de Uso en cualquier momento y sin previo aviso. El usuario estará sujeto a las políticas y Condiciones vigentes en el momento en que efectúe cada pedido, salvo que por ley Regalo del Corazón o Heart Gift deba hacer cambios, en cuyo caso, los posibles cambios afectarán también a los pedidos que el usuario hubiese hecho previamente.</li>
    </ul>  



</p>
    </div>
    <?php include 'footer.php'?>
</body>
</html>