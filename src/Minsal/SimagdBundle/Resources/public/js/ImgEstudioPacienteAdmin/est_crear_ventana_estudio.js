/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    function generarVentanaEstudioPaciente (hrefEstudio) {
        
        var width = 1000;
        var height = 700;
        var left = (screen.width/2)-(width/2);
        var top = (screen.height/2)-(height/2);

        window.open(
		      hrefEstudio,
		      '_blank',
		      "height = " + height +
			  ", width = " + width +
			  ", toolbar=0, menubar=0, location=0, status=1, scrollbars=0, resizable=0, top = " + top +
			  ", left = " + left
		  );
        
        console.log(hrefEstudio);
        
        return false;
        
    }