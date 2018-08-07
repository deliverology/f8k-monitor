<?php 
	if($data->num_rows() > 0){
		foreach($data->result() as $row)
		{
			$id = $row->id.'/'.$row->name;
			echo "
			<p>
			<a href='".site_url('download/files')."/".$row->name."'>".$row->name."</a><a class='btn btn-xs' data-toggle='modal' data-target='#myModal' onclick='file_delete(\"$id\")'><font color='red'><strong>[ X ]</strong></font></a>
			</p>
			";
		}
	}
?>