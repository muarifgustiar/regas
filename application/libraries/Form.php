<?php
class Form{
	
	private $CI;

	public function __construct(){
		$this->CI =& get_instance(); 

		$this->CI->load->library('upload');
	}
	public function get_filter_post($field){
		$post_filter = (count($this->CI->input->post('filter'))>0) ? $this->CI->input->post('filter') : array('field'=>array(0=>''),'cond'=>array(0=>''));
		// echo print_r($post_filter);
		unset($_POST['filter']);
		$total_list = count($post_filter['field']);
		$html = '<div class="filter"><div class="filterArea">
					<div class="filterForm">';
				$ct = 0;
				foreach($post_filter['field'] as $key=>$row){
					$ct++;
					$html .='<div class="filterInput">
					<select name="filter[field][]">';
					foreach($field as $value => $name){
						$html .= '<option value="'.$value.'" '.(($value==$row)?'selected':'').'>'.$name.'</option>';
					}
					$html.='</select>
						<input type="text" name="filter[cond][]" value="'.$post_filter['cond'][$key].'">';
						
					$html .= ($ct==$total_list) ? '&nbsp;<a href="#" class="addFilter"><i class="fa fa-plus"></i></a>' : '';

					$html .='</div>';
				}
		$html .='	</div>
				<button type="submit" class="btnBlue"><i class="fa fa-filter"></i>&nbsp;Filter</button>
			</div>
		</div>';

		return $html;
	}

	public function group_filter_post($field){
		$html = '<div class="filter">
				<div class="filterHeader">
				<a class="filterBtn"><i class="fa fa-filter"></i>&nbsp;Filter&nbsp;<i class="fa fa-angle-down"></i></a>

				</div>
				<div class="groupFilterArea clearfix">
					<div class="filterForm">';
					$group_filter = (count($this->CI->input->post('filter'))>0) ? $this->CI->input->post('filter') : array('field'=>array(0=>''),'cond'=>array(0=>''));
					
					// echo print_r($group_filter);
						// unset($_POST['filter']);

					foreach($field as $row){
						$html .= '<div class="groupForm">
									<div class="groupFormHeader">
										<label>'.$row['label'].'</label><i class="fa fa-sort-desc"></i>
									</div>
									<div class="groupFormContent">';
									/* New Filter Input*/

									foreach($row['filter'] as $key => $value){

										$field = explode('|',$value['table']);

										if($value['type']=='date_range'){
											// echo print_r($value);
											$html .= '<div class="groupFieldInput"><div class="groupFieldWrap">';
												$html .= '<div class="dateWrap clearfix">';
												// foreach($value as $key =>$value){

													

													// if(!isset($group_filter[$start_date])&&!isset($group_filter[$end_date])){
												if(isset($group_filter[$value['table']])){
													$iterate = array();
													if(count($group_filter[$value['table']])>0){
														foreach($group_filter[$value['table']] as $key_row => $val_row){
														foreach($val_row as $key_date => $val_date){
															$iterate[$key_date][$key_row] = $val_date;
														}
													}
													foreach ($iterate as $key => $value) {
														# code...
													}
													}
													
												}
													else{
														$html .= '<div class="groupFieldBlock "><label>'.$value['label'][0].'</label>';
														$html .= $this->CI->form->calendar(array('name'=>'filter['.$value['table'].'][start_date][]','value'=>''), false);
														$html .= '<label>'.$value['label'][1].'</label>';
														$html .= $this->CI->form->calendar(array('name'=>'filter['.$value['table'].'][end_date][]','value'=>''), false);
														$html .= '</div>';
													}
														// echo print_r($value);
														

													// }
													/*else{

														foreach ($group_filter[$start_date] as $id_field => $value_field){

															$html .= '<div class="groupFieldBlock "><label>'.$value['label'].'</label>';
															$html .= $this->CI->form->calendar(array('name'=>'filter['.$value['table'].'][0]','value'=>''), false);
															$html .= '<label>'.$value['label'][1].'</label>';
															$html .= $this->CI->form->calendar(array('name'=>'filter['.$value['table'].'][0]','value'=>''), false);
															$html .= '</div>';


														}
														
													}*/
													
												// }
												$html.='</div>';
												$html .= '<a href="#" class="addFilterGroupDate" ><i class="fa fa-plus"></i></a>&nbsp;<a href="#" class="removeFilterGroupDate" ><i class="fa fa-minus"></i></a></div>';
											$html .= '</div>';
										}else{
											$html .= '<div class="groupFieldBlock"><label>'.$value['label'].'</label>';
											$html .= '<div class="groupFieldInput"><div class="groupFieldWrap">';


											if($value['type']=='dropdown'){
												$id_bidang = $this->CI->utility->$field[2]();
												$html .= form_dropdown('filter['.$key.'][]', $id_bidang, '');
											}elseif($value['type']=='text'){
												if(!isset($group_filter[$value['type']])){
													$html .= '<input type="text" name="filter['.$value['table'].'][]" value="">';
												}else{
													foreach ($group_filter[$key] as $id_field => $value_field){
														$html .= '<input type="text" name="filter['.$value['type'].'][]" value="'.$value_field.'">';
													}
												}
											}

											$html .= '<a href="#" class="addFilterGroup" ><i class="fa fa-plus"></i></a>&nbsp;<a href="#" class="removeFilterGroup" ><i class="fa fa-minus"></i></a></div></div>';
											$html .= '</div>';

										}
									}

									
							$html .='</div>';
						$html .= '</div>';
					}

		$html .='</div><button type="submit" class="btnBlue"><i class="fa fa-filter"></i>&nbsp;Filter</button></div></div>';

		return $html;
	}

	public function generate_query($instance,$filter){
		// echo print_r($this->CI->input->post());
		/*CLEAN ALL ARRAY*/
		$clean_filter = array();
		// echo print_r($_POST);
		if($this->CI->input->post('filter')){
			foreach($this->CI->input->post('filter') as $key => $val_arr){
				if(isset($val_arr[0])){
					if(count($val_arr[0])==1 && $val_arr[0]=='') 
						unset($_POST['filter'][$key]);
				}
			}
			
			/*END CLEAN ALL ARRAY*/
			$field_array = $this->field_array();
			$join = array();
			$date_array = array();

			// echo print_r($)


			if($this->CI->input->post('filter')){
				foreach($this->CI->input->post('filter') as $key => $row){
					$str = '';
					$field = explode('|',$key);
					
					$total_row = 0;	

					if($field[1] !='start_date'&&$field[1] !='end_date'){
						$str .= '(';

						foreach($row as $k => $value){
							
							if($value!=''){

								if(isset($field_array[$field[0]])){
									$join[$field[0]] = $field_array[$field[0]];
								}

									$pre = ($total_row==0) ? '' : ' OR ';
									$str .= $pre.' '.$field[0].'.'.$field[1].' LIKE "%'.$value.'%"';
									
									
									if(isset($field[2])){
										$instance->where($field[0].'.type',$field[2]);
									}
					
							}
							$total_row ++;
						}

						$str .= ')';
						$instance->where($str,NULL,TRUE);
					}else{
						$i = 0;
						// foreach($row as $k => $value){
						// 	$date_array[$i]['start_date'] = array($field[0],$field[1],$value);
						// 	$date_array[$i]['end_date'] = array($field[0],$field[1],$value);
						// 	$i++;
						// }
						
					}
						
				}
				
				$total_row = 0;	
				if(!empty($date_array)){
					// $str .= '(';

					// 	if(isset($field_array[$field[0]])){
					// 		$join[$field[0]] = $field_array[$field[0]];
					// 	}
						// echo print_r($date_array);
						// foreach($date_array as $key => $value){

						// 	$pre = ($total_row==0) ? '' : ' OR ';
						// 	$str .= $pre.' ('.$value[0].'.'.$value[1].' >= "'.$value[3].'" AND '.$value[0].'.'.$value[1].' <= "'.$value[3].'")';
						// 	$total_row ++;

						// }

					// $str.=')';
					// $instance->where($str,NULL,TRUE);
				}

				foreach($join as $field => $join_str){
					$instance->join($field, $join_str);
				}
			}
		}
		return $instance;

	}

	public function field_array(){
		$arr = array(
			'tb_legal'=>'tb_legal.id=ms_vendor_admistrasi.id_legal',
			'ms_akta'=>'ms_akta.id_vendor=ms_vendor.id',
			'ms_pengurus'=>'ms_pengurus.id_vendor=ms_vendor.id',
			'ms_pemilik'=>'ms_pemilik.id_vendor=ms_vendor.id',
			'ms_situ'=>'ms_situ.id_vendor=ms_vendor.id',
			'ms_ijin_usaha'=>'ms_ijin_usaha.id_vendor=ms_vendor.id',
			'tb_bidang'=>'tb_bidang.id_dpt_type=ms_ijin_usaha.id_dpt_type',
			'tr_dpt'=>'tr_dpt.id_vendor=ms_vendor.id',
			'ms_pengalaman'=>'ms_pengalaman.id=ms_vendor.id',
		);
		return $arr;
	}
	

	function get_kurs($name,$data){
		$arr = $this->CI->db->select('id,symbol')->where('del',0)->get('tb_kurs')->result_array();
		$result = array();
		foreach($arr as $key => $row){
			$result[$row['id']] = $row['symbol'];
		}
		return form_dropdown($name, $result, $data,'');
	}

	protected function build_str_query($query = ''){
		$arr = preg_match_all('/{(.*?)}/', $query, $display);

		$return = $query;
		$return_arr['var'] = $display[1];
		
		$initial = false;
		$x = 0;
		foreach($display[0] as $haystack){
			if(!$initial){ 
				$initial = true; 
				if((strpos($string, $haystack) + 1)) $return_arr['start_from'] = "var"; else $return_arr['start_from'] = "cons";
			}

			$return = str_replace($haystack, "|", $return);
			$x++;
		}
		
		$return = explode("|", $return);
		$y = 0;
		foreach($return as $_return){
			if($_return) $return_arr['cons'][] = $_return;
			$y++;
		}	
		
		$start = $return_arr['start_from'];
		if($start == "var") $end = "cons"; else $end = "var";

		$i = 0;
		$to_return = array();
		foreach($return_arr[$start] as $_start){
			array_push($to_return, array('type' => $start, 'data' => $_start));
			if($return_arr[$end][$i]) array_push($to_return, array('type' => $end, 'data' => $return_arr[$end][$i]));
			$i++;
		}
		
		return $to_return;
	}

	public function text_box($param = array()){
		$return = '<input type="text"';
		foreach($param as $index => $_param){
			$return .= ' '.$index.'="'.$_param.'"';
		}
		$return .= '/>';

		return $return;
	}

	public function decimal($param = array()){
		$return = '<input clas="dekodr-decimal" type="text"';
		foreach($param as $index => $_param){
			$return .= ' '.$index.'="'.$_param.'"';
		}
		$return .= '/>';

		return $return;
	}

	public function password($param = array()){
		$return = '<input type="password"';
		foreach($param as $index => $_param){
			$return .= ' '.$index.'="'.$_param.'"';
		}
		$return .= '/>';

		return $return;

	}

	public function hidden($param = array()){
		$return = '<input type="hidden"';
		foreach($param as $index => $_param){
			$return .= ' '.$index.'="'.$_param.'"';
		}
		$return .= '/>';

		return $return;

	}

	public function button($param = array()){
		$return = '<input type="button"';
		foreach($param as $index => $_param){
			$return .= ' '.$index.'="'.$_param.'"';
		}
		$return .= '/>';

		return $return;

	}

	public function text_area($param = array()){
		$value = $param['value'];
		unset($param['value']);

		$return .= '<textarea';
		foreach($param as $index => $_param){
			$return .= ' '.$index.'="'.$_param.'"';
		}
		$return .= '>';
		$return .= $value;
		$return .= '</textarea>';

		return $return;
	}

	public function drop_down($param = array(), $value = array()){
		$selected = $param['value'];
		unset($param['value']);

		$return = '<select';
		foreach($param as $index => $_param)
			$return .= ' '.$index.'="'.$_param.'"';
		
		$return .= '>';

		$return .= '<option value=""> - pilih - </option>';

		foreach($value as $index => $_value){
			$return .= '<option value="'.$index.'"';
			if($selected == $index) $return .= ' selected="selected"';
			$return .= '>'.$_value.'</option>';
		}

		$return .= '</select>';

		return $return;
	}

	public function drop_down_db($param = array(), $setting = array()){
		$string = $this->build_str_query($setting['label']);
		$value = array();
		$sql = "SELECT * FROM ".$setting['table'];
		if($setting['where']) $sql .= ' WHERE '.$setting['where'];
		
		$sql = $this->CI->db->query($sql);
		
		foreach($sql->result() as $data){
			
			$label = "";

			foreach($string as $_string){

				if($_string['type'] == "var") $label .= $data->$_string['data'];
				else $label .= $_string['data'];
			}
			$array[$data->$setting['value']] = $label;		
		}

		return $this->drop_down($param, $array);
	}

	public function calendar($param = array(), $disable_day = false){
		$return = '';
		$class = 'dekodr-calendar';
		if(!$param['value']) $param['value'] = date("Y-m-d");


		for($i=1;$i<=31;$i++){ $x = $i; if($i < 10) $x = "0".$i; $day[$x] = $x; }
		$month = array(
			'01' => 'Januari',
			'02' => 'Febuari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember'
		);
		for($i=2032;$i>=1900;$i--) $year[$i] = $i;
	
		$return .= '<div class="dekodr-calendar" style="display : inline-block">';
		
		if(!$disable_day)
			$return .= $this->drop_down(array('class' => 'dekodr-calendar-day', 'id'=>$param['name'].'_date-date',	'value' => date("d", strtotime($param['value'])),'onClick'=>'changeCal_date(\''.$param['name'].'\')'), $day);
		else		
			$return .= $this->hidden(array('class' => 'dekodr-calendar-day', 'value' => '01'));

		$return .= $this->drop_down(array('class' => 'dekodr-calendar-month', 'id'=>$param['name'].'_date-month',	'value' => date("m", strtotime($param['value'])),'onClick'=>'changeCal_date(\''.$param['name'].'\')'), $month);
		$return .= $this->drop_down(array('class' => 'dekodr-calendar-year', 'id'=>$param['name'].'_date-year', 'value' => date("Y", strtotime($param['value'])),'onClick'=>'changeCal_date(\''.$param['name'].'\')'), $year);		
		
		$return .= $this->hidden(array('name' => $param['name'], 'class' => 'dekodr-calendar-hidden', 'value' => $param['value'],'id'=>$param['name']));

		$return .= '</div>';


		return $return;
	}

	public function lifetime_calendar($param = array()){
		$return = '<div class="dekodr-calendar-lifetime" style="display : inline-block">';
			$return .= $this->calendar($param);
			$return .= '<div class="dekodr-calendar-checkbox">';
				$checked = ($param['value']=='lifetime') ? 'checked' : '';
				$return .= '<div><label><input type="checkbox" '.$checked.' name="'.$param['name'].'" value="lifetime" class="dekodr-calendar-checkbox-input"/>Selama Perusahaan Berdiri</label></div>';
			$return .= '</div>';
		$return .= '</div>';
		
		return $return;
	}

	public function file($param = array()){
		$path = $param['path'];
		unset($param['path']);

		if(!$param['value']){
			$return = '<input type="file"';
			foreach($param as $index => $_param){
				$return .= ' '.$index.'="'.$_param.'"';
			}
			$return .= '/>';
			$return .= $this->hidden(array('name' => $param['name'].'-path', 'value' => $path));
		}
		else{
			$return .= '<div class="dekodr-file">';
				$return .= '<div class="dekodr-file-link">';
					$return .= '<a target="_blank" href="'.base_url().'lampiran/'.$path.'/'.$param['value'].'">Klik disini untuk melihat berkas</a>, atau <a class="dekodr-file-link-trigger">klik disini untuk mengganti berkas</a>';
				$return .= '</div>';


				$return .= '<div class="dekodr-file-container" style="display : none">';
					$return .= '<input class="dekodr-file-container-input" type="file"';
					foreach($param as $index => $_param){
						$return .= ' '.$index.'="'.$_param.'"';
					}
					$return .= '/>';
					$return .= '&nbsp; <a class="dekodr-file-container-cancel">klik disini untuk batal mengganti berkas</a>';
				$return .= '</div>';


				$return .= $this->hidden(array('name' => $param['name'].'-old', 'value' => $param['value']));
				$return .= $this->hidden(array('name' => $param['name'].'-path', 'value' => $path));
			$return .= '</div>';
		}

		return $return; 
	}

	public function upload($name = ''){
		$path = $_POST[$name.'-path'];

		$config['upload_path']		= './lampiran/'.$path;
		$config['allowed_types']	= 'gif|jpg|png|bmp|jpeg|pdf|xls|xlsx';
		$config['max_size']			= '15000';
		$config['file_name'] 		= $file_name = date("YmdHis").rand(1, 9); 

		$this->CI->upload->initialize($config);

        if(!$this->CI->upload->do_upload($name))
			return array('status' => 'error', 'message' => $this->CI->upload->display_errors());
		else{
			$_POST[$name] = $file_name.$this->CI->upload->data('file_ext');
			return array('status' => 'success', 'message' => 'upload success');
		}
	}

	public function input($rule = array()){
		if($_FILES){
			foreach($_FILES as $index => $data){
				if(!$err = $this->upload($index)) return $err;
			}
		}

		$return = new stdClass();

		foreach($_POST as $index => $data){

			if(strpos($index, "-old")){
				if(!$_FILES[$index])
					$index = str_replace("-old", "", $index);
			}

			$search = array(
			    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
			    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
			    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
			    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
			);
			$_data = preg_replace($search, '', $data);
			
			$return->{$index} = $data;
		}

		return $return;
	}

	public function get_temp_data($field_name = ''){
		$form = $this->CI->session->userdata('form');
		return (set_value($field_name)) ? set_value($field_name):((isset($form[$field_name]))?$form[$field_name]:'') ;
	}
}

?>