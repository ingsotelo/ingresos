<body style=" font-size: 15px;">
  <div id="content">
    <h4 align="center">CONSTANCIA DE REGISTRO DE PERFIL DEL CONTRIBUYENTE DEL ESTADO DE GUERRERO</h4> 
    <p align="right">CHILPANCINGO DE LOS BRAVO , GUERRERO A 14 DE NOVIEMBRE DE 2019</p>
  </div>
  <br/>

<p style="background-color:#EEEEEE;" align="left"><b>Datos de Identificación del Contribuyente:</b></p>

<table width="100%">
  <tr>
    <th>RFC:</th>
    <td>{{$rfc}}</td>
  </tr>
  <tr>
    <th>CURP:</th>
    <td>{{$curp}}</td>
  </tr>
  <tr>
    <th>Nombre:</th>
    <td>{{$nombre}}</td>
  </tr>
</table>
  
  
<p style="background-color:#EEEEEE;" align="left"><b>Datos de Ubicación:</b></p>

<table width="100%">
  <tr>
    <th>Código Postal:</th>
    <td>{{$codigo}}</td>
  </tr>
  <tr>
    <th>Nombre de Vialidad:</th>
    <td>{{$calle}}</td>
  </tr>
  <tr>
    <th>Número Exterior:</th>
    <td>{{$numero}}</td>
  </tr>
  <tr>
    <th>Nombre de la Colonia:</th>
    <td>{{$colonia}}</td>
  </tr>
  <tr>
    <th>Nombre de la Localidad:</th>
    <td>{{$ciudad}}</td>
  </tr>
  <tr>
    <th>Nombre del Municipio:</th>
    <td>{{$municipio}}</td>
  </tr>
  <tr>
    <th>Correo Electrónico:</th>
    <td>{{$email}}</td>
  </tr>
  <tr>
    <th>Número de Telefono Fijo:</th>
    <td>-</td>
  </tr>
  <tr>
    <th>Número de Telefono Móvil:</th>
    <td>-</td>
  </tr>
</table>

<p style="background-color:#EEEEEE;" align="left"><b>Datos de Ubicación:</b></p>

<table width="100%">
  <tr>
    <th>Actividad Económica:</th>
    <td>{{$actividad}}</td>
  </tr>
  <tr>
    <th>Sub-Actividad Económica:</th>
    <td>{{$subactividad}}</td>
  </tr>
</table>


<p>Sus datos personales son incorporados y protegidos en los sistemas de la Secretaria, de conformidad con los Lineamientos de Protección de Datos
Personales y con diversas disposiciones fiscales y legales sobre confidencialidad y protección de datos, a fin de ejercer las facultades
conferidas a la autoridad fiscal.</p>



    <p><b>Cadena Original Sello:</b></p>
    <p><small>||2019/11/11|SACY811001VE5|CONSTANCIA DE SITUACIÓN FISCAL|200001088888800000031||</small></p>

    <p><b>Sello Digital:</b></p>
    <p><small>XpEg4OxXufgq51lwsaTC1rWtzR6awC53D0Y667PQ14oSEiM8bcrujxI3O4uh/lkKO6oEU+yFme/dCIIB2DznCVL</small></p>
    <p><small>0BIYFRZkPvuLB16/pd44YuOd6q5OSThvWy/FL+icEY1c4qE9NYAusz1mqjLsNYg9whsUwcLTeyEVxxuUWCaY=</small></p>


  <div align="right">
    <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(150)->generate($qrcode)) }} ">
  </div>

</body>


  
  