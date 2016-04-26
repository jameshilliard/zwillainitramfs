<script>
function f_get_system_info() {
	$.ajax({
		url: '/cgi-bin/get-mem.cgi',
		type: 'GET',
		dataType: 'json',
		timeout: 30000,
		cache: false,
		success: function(data) {
			var percent;
			try {


				percent = 0;
				if (data.mem_used != '' && data.mem_total != '' && data.mem_total != '0') {
					percent = Math.round(data.mem_used * 100 / data.mem_total);
				}
				$("#ant_mem_used_div").css("width", percent + "%");
				$("#ant_mem_used").html(data.mem_used + ' kB / ' + data.mem_total + ' kB (' + percent + '%)');

				percent = 0;
				if (data.mem_free != '' && data.mem_total != '' && data.mem_total != '0') {
					percent = Math.round(data.mem_free * 100 / data.mem_total);
				}
				$("#ant_mem_free_div").css("width", percent + "%");
				$("#ant_mem_free").html(data.mem_free + ' kB / ' + data.mem_total + ' kB (' + percent + '%)');

				percent = 0;
				if (data.mem_buffers != '' && data.mem_total != '' && data.mem_total != '0') {
					percent = Math.round(data.mem_buffers * 100 / data.mem_total);
				}
				$("#ant_mem_buffers_div").css("width", percent + "%");
				$("#ant_mem_buffers").html(data.mem_buffers + ' kB / ' + data.mem_total + ' kB (' + percent + '%)');

				percent = 0;
				if (data.mem_cached != '' && data.mem_total != '' && data.mem_total != '0') {
					percent = Math.round(data.mem_cached * 100 / data.mem_total);
				}
				$("#ant_mem_cached_div").css("width", percent + "%");
				$("#ant_mem_cached").html(data.mem_cached + ' kB / ' + data.mem_total + ' kB (' + percent + '%)');

			}
			catch (err) {
				alert('Invalid system and miner configuration file. Edit manually or reset to default.');
			}
		},
		error: function() {
			//alert('Ajax Error');
		}
	});
}

$(document).ready(function() {
	f_get_system_info();
});
</script>
     <div class="panel panel-primary panel-in-footer">
         <div class="panel-body">
            <div class="stat-pair stat-pair-qr">
               <div class="stat-value">
                  Donations make us feel like champs <i class="icon icon-medal"></i>
               </div>
               <div class="stat-label stat-label-donate">
                  <div class="donate-address">
                      <a href="bitcoin:16L45ub3SpHZ6dYbqseip7Fv4BEJSj9xEo?label=cryptoGlance" data-toggle="modal" data-target="#qrDonateBTC" title="Donate Bitcoin (BTC)"><img src="/images/coin/bitcoin.png" alt="Bitcoin" /></a> <span data-toggle="modal" data-target="#qrDonateBTC">16L45ub3SpHZ6dYbqseip7Fv4BEJSj9xEo</span>
                  </div>
               </div>
               <div class="stat-value">
                    <span class="icon-update-available"><a title="New version of cryptoGlance is available!" href="update.php"><i class="icon icon-circle-arrow-up green"></i></a></span>
                    <span class="cgVersion" onclick="versionCheck()"><?php echo CURRENT_VERSION ?></span>
                    <span class="icon-update-available"><a title="New version of cryptoGlance is available!" href="update.php"><i class="icon icon-circle-arrow-up green"></i></a></span>
               </div>
            </div>
            
            <div class="stat-pair">
               <div class="stat-label">
                <div class="social-box">
                  <a rel="external" class="social-icon" href="https://www.zwilla.de/de/faq-items/custom-firmware-antminer-s7/"><img src="/images/icon/bugreport.png"></a>
                  <a rel="external" class="social-icon" href="https://www.zwilla.de/downloads/custom-firmware-antminer-s7/"><img src="/images/icon/update-firmware.png"></a>
                  <a rel="external" class="social-icon" href="https://www.zwilla.de/shop/my-soft-account/"><img src="/images/icon/register-now.png"></a>
                </div>
                <a href="https://github.com/Zwilla/cryptoGlance-web-app/tree/Zwilla-patch-1" rel="external"><button type="button" class="btn btn-default">Source on Github</button></a>
              </div>
            </div>
            
            
            
            
            
          <div class="stat-pair">
               <div class="stat-label">
                <div class="social-box">
   <fieldset class="cbi-section">
				<table>
					<tr>
						<td >Total</td>
						<td id="memtotal">

										<small id="ant_mem_used">0 kB / 0 kB (0%)</small>

						</td>
					</tr>
					<tr>
						<td>Free</td>
						<td id="memfree">
			
										<small id="ant_mem_free">0 kB / 0 kB (0%)</small>
				
						</td>
					</tr>
					<tr>
						<td>Cached</td>
						<td id="memcache">

										<small id="ant_mem_cached">0 kB / 0 kB (0%)</small>

							
						</td>
					</tr>
					<tr>
						<td>Buffered</td>
						<td id="membuff">

										<small id="ant_mem_buffers">0 kB / 0 kB (0%)</small>

						</td>
					</tr>
                    <tr>

                   
				</table>
			</fieldset>
            </div>
            <input class="btn btn-default" type=button onClick="parent.location='/cgi-bin/free_memory.cgi'" value='give me more mem'> 
         </div>
         

            </div>
            
            
         </div><!-- / .panel-body -->
      </div>


