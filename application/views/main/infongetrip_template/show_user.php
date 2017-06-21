    	<tr>
      		<td> <b>Phone</b> </td>
      		<td>:</td>
      		<td> <?php echo $user->phone; ?> </td>
      	</tr>
      	 <tr>
      		<td> <b>Address</b> </td>
      		<td>:</td>
      		<td> <p> <?php echo $user->address; ?> </p> </td>
      	</tr>
      	 <tr>
      		<td> <b>Email</b> </td>
      		<td>:</td>
      		<td><?php echo $user->email ?></td>
      	</tr>
      	 <tr>
      		<td> <b>Site</b> </td>
      		<td>:</td>
      		<td> <a href="https://<?php echo $user->site; ?>"><?php echo $user->site; ?></a></td>
      	</tr>
      	      	<tr>
      		<td> <b>Birthday</b> </td>
      		<td>:</td>
      		<td><?php echo date('d M Y',strtotime($user->birthday)) ; ?></td>
      	</tr>
      	 <tr>
      		<td> <b>Gender</b> </td>
      		<td>:</td>
      		<td> <?php echo $user->gender; ?> </td>
      	</tr>