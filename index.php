<!doctype html>
<html>
	<head>
<meta charset="utf-8">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0-rc2/css/bootstrap.css" rel="stylesheet" media="screen">
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="tablesorter.js"></script>
		<style>
			td{
				    max-width: 650px;
			}
			th{
				cursor:pointer;
			}
		</style>
	</head>
	<body>

		<div class="container">
		<h1 style='text-align:center;'>Test 301 redirect</h1>

		<h3 style='text-align:center;'>Список сайтов</h3>
		<table id='saitTable' class='table' style='margin-top:1.5em;'>
		<thead>
			<tr>
				<th>Новое зеркало</th>
				<th>Старое зеркало</th>
			</tr>
		</thead>
		<tbody> 
			<?php
				$json_url = "links.json";
				 $json = file_get_contents($json_url);
				 $llinks = json_decode($json, TRUE);
				 // print '<pre>';
				 // print_r ($llinks);
				 // print '</pre>';
				 $table = '';
				 $iii = 0;
				 foreach($llinks as $val){	



				 $unik[$iii]['new'] = $val['new'];
				 $unik[$iii]['old'] = $val['old'];				 

				  $iii++;
				 }
				 $resultt = array_map("unserialize", array_unique(array_map("serialize", $unik)));
				 foreach($resultt as $val){	
				 // print '<pre>';
				 // print_r ($resultt);
				 // print '</pre>';
				 $table .= "<tr>";
				 $table .= "<td>" . $val['new'] ."</td>"; 				 
				 $table .= "<td>" . $val['old'] ."</td>"; 								
				  $table .= "</tr>";
				 }
				  echo $table;
			?>
		</tbody>	
		</table>		
		
		
		
		<h3 style='text-align:center;'>Список url</h3>
		<center>
		<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
		  Добавить сайт
		</button>
		</center>
		<table id='resultTable' class='table' style='margin-top:1.5em;'>
		<thead>
			<tr>
				
				<th>Новое зеркало</th>
				<th>Старое зеркало</th>
				<th>Ссылка</th>
				<th>Дата</th>
				<th>Статус</th>
				<th>id</th>
				<th></th>
			</tr>
		</thead>
		<tbody id="paket">
			

			<?php
				$json_url = "links.json";
				 $json = file_get_contents($json_url);
				 $llinks = json_decode($json, TRUE);
				 // print '<pre>';

				 // print_r ($llinks);
				 // print '</pre>';
				 $table = '';
				 foreach($llinks as $vall){				 
				 $table .= "<tr>";
				 foreach($vall as $valuess){

				  
				  if(is_array($valuess)) {
				   foreach($valuess as $kkey){
				   $table .= "<td>" . $kkey['value'] ."</td>"; 
				   $table .= "<td>" . $kkey['stat'] ."</td>"; 
				   }
				  }
				  else {
				   $table .= "<td>" . $valuess ."</td>";

				  }    
				 }
				   $table .= "<td> <input type='checkbox' name='del' value='".$vall['id']."'> </td>";
				  $table .= "</tr>";
				 }
				  echo $table;
			?>
		</tbody>	
		</table>
		<a style='    float: right;' id='del' class='btn btn-primary' href='#'>Удалить</a>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Добавить сайт</h4>
              </div>
              <div class="modal-body">
                <form method="POST" id="formmodal" action="javascript:void(null);" onsubmit="modalCall()">                    
                    <table width="100%">
                        <tr>                        
                            <td>Новое зеркало: </td> <td><input type="text" name="new" placeholder="Новое зеркало"></td>
                        </tr>
                        <th>&nbsp;</th>
                        <tr>                        
                            <td>Старое зеркало: </td> <td><input type="text" name="old" placeholder="Старое зеркало"></td>
                        </tr>
                        <th>&nbsp;</th>
                        <tr>                        
                            <td>Внутренние ссылки: </td> <td><textarea name="links" placeholder="Внутренние ссылки"></textarea></td>
                        </tr>
                    </table>
					<input type="text" name="date" style='display:none;' value="<?php echo date("m.d.y"); ?>">
					<input value="Добавить" class="btn btn-primary" type="submit">
                </form>
              </div>
            </div>
          </div>
        </div>

		<center>
			<a id="RUN" class="btn btn-primary"> Запустить проверку </a>
                <!-- <form method="POST" id="curl" action="javascript:void(null);" onsubmit="curlstart()">                    
 					<input value="Запустить проверку" class="btn btn-primary" type="submit">
                </form>-->
		</center>
		
		
		
		
		
		<h3 style='text-align:center;'>Лог ошибок</h3>
		<table id='errorTable' class='table tablesorter'>
				<thead>
				<tr>

				<th>Старое зеркало</th>
				<th>Ссылка</th>
				<th>Ответ сервера</th>
				<th></th>
				</tr>
				</thead>
				<tbody id='errort'> 
			<?php
				$json_url = "error.json";
				 $json = file_get_contents($json_url);
				 $llinks = json_decode($json, TRUE);
				 $table = '';
				 foreach($llinks as $val){				 
				 $table .= "<tr>";
				 foreach($val as $values){ 
				  if(is_array($values)) {
				   foreach($values as $key){
				   $table .= "<td>" . $key['value'] ."</td>"; 
				   $table .= "<td>" . $key['stat'] ."</td>"; 
				   }
				  }
				  else {
				   $table .= "<td>" . $values ."</td>";
				  }    
				 }
				  $table .= "</tr>";
				 }
				  echo $table;
						?>
					</tbody>	
					</table>		
		</div>		
		
		
		
		
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0-rc2/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function() {
			$('body').on('click', '#RUN',  function() {
				$('#paket').html('');
				getTableRow();
			});
			$('body').on('click', '#del',  function() {
				var idDel = $('#paket input:checked');
				var iddDel = [];
				
				$.each( $('#paket input:checked'), function( key, value ) {
					iddDel[key] = $(this).val();				
				   $(this).parents('tr').remove();
				});
				console.log(iddDel);
						$.ajax({
							type: 'POST',
							url: "del.php",
							data: {inputs: iddDel},
							success: function(data) {
								$(this).parents('tr').remove();
								console.log("Url Удален");
							},
							error:  function(xhr, str){
								alert('аякс ошибка: ' + xhr.responseCode);
							}
						});
				return false;						
			});			
		});

		
	
		function getTableRow() {
			data = {};
			data.limit = 10;
			data.offset = $('#paket').find('tr').length;
			

			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: 'headers.php',
				data: data,
				success: function(response){
				console.log(data);
					if (response.html) {
						$(response.html).appendTo('#paket');
						
					};
					if (response.count == data.limit) {
						getTableRow();
					};
				},
					error:  function(xhr, str){
						alert('аякс ошибка: ' + xhr.responseCode);
					}
				
			});
		}


			var error = [];
				$.each($('#paket tr td'), function( key, value ) {	
				if($(this).text().match(/Error/)){
					error += '<tr>';
					
				 error += $(this).parents('tr').html();	
					error += '</tr>';				 
				}
				});				
				
				$('#errort').html(error);
				var idtab = [];
				$.each($('#errort tr'), function( key, value ) {	
					$(this).find('td:eq(1)').remove(); 
					$(this).find('td:eq(2)').remove(); 
					idtab[key] = $(this).find('td:eq(3)').text();
					$(this).find('td:eq(3)').remove(); 
					$(this).find('td:eq(3)').html('<button id="curlreply" class="btn btn-primary" data-id="'+idtab[key]+'">Проверка</button>'); 
					
				});	
				$('#errort').after('Количество ошибок:' + $('#errort tr').length);
 
	</script>
	<script>
	$(document).ready(function(){
		$(function(){
			$("#errorTable").tablesorter();
			$("#resultTable").tablesorter();
			$("#saitTable").tablesorter();
		});
	});
	</script>
		<script type="text/javascript" language="javascript">
			function call() { //
			  var msg   = $('#formx').serialize();
				$.ajax({
				  type: 'POST',
				  url: 'res.php',
				  data: msg,
				  success: function(data) {
					$('#results').html(data);
				  },
				  error:  function(xhr, str){
					alert('аякс ошибка: ' + xhr.responseCode);
				  }
				});
		 
			}
			function modalCall(){
				// отправка модальной формы
					var msgg = $("#formmodal").serialize();
                    $.ajax({
						type: 'POST',
                        url: "res.php",
                        data: msgg,
						success: function(data) {
							// console.log(data);
							$('#resultTable').html(data);
							$('#myModal .close').click();
						},
						error:  function(xhr, str){
							alert('аякс ошибка: ' + xhr.responseCode);
						}
                    });


			}	
			function curlstart(){
				// curl start
				alert("Проверка url началась");
					var msgg = $("#curl").serialize();
                    $.ajax({
						type: 'POST',
                        url: "curl.php",
                        data: msgg,
						success: function(data) {
							// console.log(data);
							$('#resultTable').html(data);
							alert("Проверка url завершена");
						},
						error:  function(xhr, str){
							alert('аякс ошибка: ' + xhr.responseCode);
						}
                    });


			}
				$(document).ready(function(){
					$('#errorTable button').on('click',function(){
						var mssgg = $(this).data('id');
						var lklink = $(this).parents('tr').find('td:eq(1)').text();
						var tert = $(this).parents('tr');
						$.ajax({
							type: 'POST',
							url: "replycurl.php",
							data: '&id=' + mssgg + '&link=' + lklink,
							success: function(data) {
								if(data == 'true'){
									alert('301 redirect');
									tert.remove();
								}else{
									alert('Все плохо');
								}
								
								console.log(data);
								//$('#errorTable').html(data);
							},
							error:  function(xhr, str){
								alert('аякс ошибка: ' + xhr.responseCode);
							}
						});						
					});					
				});

		</script>		
	</body>
<html>
<?php


?>