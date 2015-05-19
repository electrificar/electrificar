{include file="../common/header.tpl"}

<div class="">
	<div id="reservation-form" class="block">
    	<div class="block-inner white block-shadow">
        	<div class="block-title">
            	<h3>Consulta las zonas disponibles</h3>
            </div>
            <!-- /.block-title -->

            <form method="post">
            
            	<div class="row">
            		                    
                    <table class="table table-striped m-b-none">
						<thead>
							<tr>
								<th>Zona</th>
								<th width="350">Puntos Carga</th>
								<th>Vehículos en zona</th>
							</tr>
						</thead>
						<tbody>
							{if $zonas!=null}
								{foreach from=$zonas key=cid item=zona}
									<tr>
										<td>Zona {$zona->id_zona}</td>
										<td>{$zona->num_puntos_carga}</td>
										<td>{$zona->num_vehiculos_zona}</td>
									</tr>
								{/foreach}
							{else}
								<tr>
									<td style="text-align:center;" colspan="7">No hay zonas dadas de alta</td>
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