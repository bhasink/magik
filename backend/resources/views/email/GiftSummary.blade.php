<p>Dear Admin,</br>
</br>Today's received following enquiries.</p>
<table border="1" hspace="0" vspace="0" cellpadding="1" cellspacing="1">
<tr>
<th>Code</th>
<th>Gift</th>
<th>Name</th>
<th>Email</th>
<th>Mobile</th>
<th>City</th>
<th>State</th>

<th>Distributer</th>
<th>Delivered</th>
<th>Status</th>

</tr>
 @foreach($input as $input)
        <tr>
		<td>{{$input->code}}</td>
		<td>{{$input->gift_name}}</td>
		<td>{{$input->name}}</td>
		<td>{{$input->email}}</td>
		<td>{{$input->mobile}}</td>
		<td>{{$input->city}}</td>
		<td>{{$input->state_name}}</td>
		<td>{{$input->distributor_name}}</td>
		<td>{{$input->delivery}}</td>
		<td>{{$input->status}}</td>
		</tr>
    @endforeach
   
   
   

</table>

<p>Thanks & Regards <br/><br/> <strong>Magik lights</strong></p>