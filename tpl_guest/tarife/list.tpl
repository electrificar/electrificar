{include file="../common/header.tpl"}

<div class="">
	<div id="reservation-form" class="block">
    	<div class="block-inner white block-shadow">
        	<div class="block-title">
            	<h3>Consulta las tarifas disponibles</h3>
            </div>
            <!-- /.block-title -->

            <form method="post">
            
            	<div class="row">
            		                    
                    <table class="table table-striped m-b-none">
						<thead>
							<tr>
								<th>Nombre</th>
								<th width="350">Precio</th>
								<th>Precio de descuento</th>
								<th width="65">Duración</th>
							</tr>
						</thead>
						<tbody>
							{if $tarifas!=null}
								{foreach from=$tarifas key=cid item=tarifa}
									<tr>
										<td>{$tarifa->nombre}</td>
										<td>{$tarifa->precio}</td>
										<td>{$tarifa->precio_descuento}</td>
										<td>{$tarifa->duracion}</td>
									</tr>
								{/foreach}
							{else}
								<tr>
									<td style="text-align:center;" colspan="7">No hay tarifas dadas de alta</td>
								</tr>
							{/if}
						</tbody>
					</table>
				</div>
			</form>
		</div>
	</div>
</div>		                   

{include file="../common/footer.tpl"}