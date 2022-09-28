<!DOCTYPE html>
<html>
<head>
	<title>Email</title>
</head>
<body>
	@php
		$data =str_replace("{contact_name}",$user->first_name." ".$user->last_name,$temp_data->desc);
		$data =str_replace("{event_date}", $event_data->date, $data);
		$data =str_replace("{event_time}", $event_data->time, $data);
		$data =str_replace("{mode}", $event_data->mode_name, $data);
		$data =str_replace("{mode_id}", $event_data->mode_id, $data);
		$data =str_replace("{business_logo}", "Black Lion Investment Group", $data);
		$data =str_replace("{event_type}", $event_data->event_type == 1 ? "Online": "Offline", $data);
		$data =str_replace("{venue}", $event_data->venue, $data);
		$data =str_replace("{current_date}", date('Y-m-d'), $data);
		$data =str_replace("{contact_email}", $user->email, $data);
		$data =str_replace("{contact_phone}", $user->contact_no, $data);
		print_r(json_decode($data,true));
	@endphp
</body>
</html>