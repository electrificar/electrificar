{include file="../common/header.tpl"}

{include file="../common/sidebar.tpl"}

<link rel="stylesheet" href="/admin/css/jquery.range.css">
<link rel="stylesheet" href="/admin/js/datepicker/datepicker.css" type="text/css" />
<section id="content">
	<section class="vbox">
		<section class="scrollable padder">
			<div class="m-b-md">
            	<h3 class="m-b-none">
            		<i class="fa fa-plus"></i >
            		Añadir zona
            		<a title="Volver atrás" style="width:40px;font-size:20px;" class="pull-right btn btn-rounded btn-sm btn-icon btn-default" href="/admin/zonas/">
            			<i class="fa fa-mail-reply"></i>
            		</a>
            	</h3>
            </div>
			<section class="panel panel-default">
                <header class="panel-heading font-bold">
                  Localización de zona
                </header>
                <div class="panel-body">
                  <form id="form-zona" enctype="multipart/form-data" method="post" action="/admin/guardar-zona/" class="form-horizontal" data-validate="parsley">
                  	<input type="hidden" name="id_zona" value="{$zona->id_zona}" />
                  	{foreach from=$zona->longitudes key=cid item=longitud}
                  		<input class='longitud' type='hidden' name='logintudes[]' value='{$longitud}'/>
                  	{/foreach}
                  	{foreach from=$zona->latitudes key=cid item=latitud}
                  		<input class='latitud' type='hidden' name='latitudes[]' value='{$latitud}'/>
                  	{/foreach}
                    <div class="form-group coordenates">
                      <label class="col-sm-2 control-label">Latitud principal</label>
                      <div class="col-sm-2">
                        <input id="latitud_principal" value="{$zona->latitud}" data-required="true" name="latitud" placeholder="40.417384" type="text" class="form-control" >
                      </div>
                      <label class="col-sm-2 control-label">Longitud principal</label>
                      <div class="col-sm-3">
                        <input id="longitud_principal" value="{$zona->longitud}" data-required="true" name="longitud" type="text" placeholder="-3.7047404" class="form-control" >
                      </div>
                      {if $zona->id_zona!=null}
                          <div class="col-sm-2">
	                      	<button type="button" onclick="buscar_mapa()" class="btn btn-success">Reiniciar</button>
	                      </div>
                      {else}
	                      <div class="col-sm-2">
	                      	<button type="button" onclick="buscar_mapa()" class="btn btn-success">Buscar</button>
	                      </div>
                      {/if}
                     </div>
                    <div class="form-group coordenates" style="display:none;">
                      <label class="col-sm-2 control-label">Latitud</label>
                      <div class="col-sm-2">
                        <input id="latitud" placeholder="40.417384" type="text" class="form-control" >
                      </div>
                      <label class="col-sm-2 control-label">Longitud</label>
                      <div class="col-sm-3">
                        <input id="longitud" type="text" placeholder="-3.7047404" class="form-control">
                      </div>
                      <div class="col-sm-2">
                      	<button type="button" onclick="anadir_coordenada()" class="btn btn-success">Añadir</button>
                      </div>
                     </div>
                    <div class="line line-dashed b-b line-lg pull-in coordenates" style="display:none;"></div>
                    <div class="col-sm-12 control-label"  id="map"></div> 
                    <div style="clear:both;" class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <div class="col-sm-12 col-sm-offset-2">
                        <button type="button" onclick="document.location='/admin/zonas/'" class="btn btn-default">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                      </div>
                    </div>                   
                  </form>
                </div>
              </section>
		</section>
	</section>
</section>
{include file="../common/footer.tpl"}
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script type="text/javascript" src="/lib/gmaps-master/gmaps.js"></script>
  <script type="text/javascript">
    var map, path, paths;
    function buscar_mapa(){
    	if($("#latitud_principal").val()!="" && $("#longitud_principal").val()!=""){
	    	$("#map").css("height","400px");

	    	$(".latitud").remove();
	    	$(".longitud").remove();
	        
	    	map = new GMaps({
	            el: '#map',
	            lat: $("#latitud_principal").val(),
	            lng: $("#longitud_principal").val()
	         });
	
	        $(".coordenates").toggle();
    	}else{
            $("#form-zona").parsley( 'validate' );
        }
    }
    
    function anadir_coordenada(){
        
        var latitud 	= $("#latitud").val();
        var longitud 	= $("#longitud").val();

        $("#form-zona").prepend("<input class='longitud' type='hidden' name='logintudes[]' value='"+longitud+"'/>");
        $("#form-zona").prepend("<input class='latitud' type='hidden' name='latitudes[]' value='"+latitud+"'/>");

        var longitudes = new Array();
        var latitudes  = new Array();

        var total = 0;
        $(".longitud").each(function(){
            longitudes.push($(this).val());
            total++;
        });

        $(".latitud").each(function(){
      	  latitudes.push($(this).val());
        });

        var prepath = "";
        
        for(var i = 0; i<total; i++){
            prepath += "["+latitudes[i]+", "+longitudes[i]+"]";
            if(i!=(total-1)){
          	  prepath += ",";
            }
        }

        path = eval("["+prepath+"]");

        map = new GMaps({
            el: '#map',
            lat: 40.417384,
            lng: -3.7047404,
            click: function(e){
              console.log(e);
            }
          });
    	
	      map.drawPolygon({
	        paths: path,
	        strokeColor: '#131540',
	        strokeOpacity: 0.6,
	        strokeWeight: 6
	      });
        
    }
    $(document).ready(function(){
      {if $zona->coordenadas!=null}  
	      map = new GMaps({
	        el: '#map',
	        lat: {$zona->latitud},
	        lng: {$zona->longitud},
	        click: function(e){
	          console.log(e);
	        }
	      });
	      $("#map").css("height","400px");
	  {/if}
	
      
	  //path = [[40.421886, -3.712968], [40.423421, -3.710822], [40.420317, -3.705887], [40.419043, -3.696917], [40.419239, -3.693527], [40.412737, -3.693484], [40.413881, -3.713526]];
      
      {if $zona->coordenadas!=null}
      	  path = eval("{$zona->coordenadas}");
	
	      map.drawPolygon({
	        paths: path,
	        strokeColor: '#131540',
	        strokeOpacity: 0.6,
	        strokeWeight: 6
	      });
      {/if}

      {if $zona->id_zona!=null}
      	map.drawOverlay({
    	  lat: {$zona->latitud},
    	  lng: {$zona->longitud},
    	  content: '<div class="overlay">Zona {$zona->id_zona}</div>'
    	});
      {/if}

   	  {foreach from=$puntos_carga key=cid item=punto_carga}
	      	map.addMarker({
	    	  lat: {$punto_carga->latitud},
	    	  lng: {$punto_carga->longitud},
	    	  title: '{$punto_carga->nombre}',
	    	  icon: "http://cdn.flaticon.com/png/32/62809.png"
	    	});
      {/foreach}   
    });
  </script>