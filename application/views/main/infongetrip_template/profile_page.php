      <div class="line-header">
      <h1><?php echo ucwords($user->user_name);  ?></h1> </div> <i class="fa fa-map-marker marker" aria-hidden="true"> <?php echo $user->name; ?> </i> 
      <h4 class="job"><i class="fa fa-briefcase" aria-hidden="true"></i> &nbsp; <i><?php echo ucwords($user->job); ?></i> </h4>
      <div class="cleaner"></div>

      <h6 class="rank"> <?php echo strtoupper('thumbs'); ?> </h6>
       <h4 >8.6 &nbsp; <i class="fa fa-thumbs-up orange" aria-hidden="true"> </i>
       <h6 class="rank"> <?php echo strtoupper('total review'); ?> </h6>
       <h4 > <?php echo $total_rows; ?>  &nbsp; <i class="fa fa-pencil-square-o orange" aria-hidden="true"></i>
  </h4>  

<ul class="nav nav-tabs tab">
    <li class="active"><a data-toggle="tab" href="#home">  Contacs</a></li>
    <li><a data-toggle="tab" href="#menu1">View Message</a></li>
<!--     <li><a data-toggle="tab" href="#menu2">Review</a></li>
    <li><a data-toggle="tab" href="#menu3">Menu 3</a></li> -->
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <div class="rank">CONTACT INFORMATION</div> 
      <a href="javascript:" class="update_user" id="update_user">Update Data</a>
    
      <table class="info-table">
   
      </table> 
      
            <table  class="update-table">
         <tr>
            <td> <b>Phone</b> </td>
            <td>:</td>
            <td> <input type="text" id="phone"> </td>
         </tr>
          <tr>
            <td> <b>Address</b> </td>
            <td>:</td>
            <td> <textarea id="address" name="address"></textarea>    </td>
         </tr>
          <tr>
            <td> <b>Email</b> </td>
            <td>:</td>
            <td><?php echo $user->email ?></td>
         </tr>
          <tr>
            <td> <b>Site</b> </td>
            <td>:</td>
            <td> <input type="text" id="site"></td>
         </tr>
                  <tr>
            <td> <b>Birthday</b> </td>
            <td>:</td>
            <td><input type="text" id="birthday"></td>
         </tr>
          <tr>
            <td> <b>Gender</b> </td>
            <td>:</td>
            <td> <select  name="gender" id="gender">
               <?php if ($user->gender == 'Male'): ?>
                  <option value="Male" selected> Male </option>
                  <option value="Female"> Female </option>                 
               <?php else: ?>
                              <option value="Male"> Male </option>
                  <option value="Female" selected> Female </option>
               <?php endif ?>

            </select> </td>
         </tr>
      </table> 
   <a href="javascript:" class="update_user" id="save_user">Save Data</a>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3 >REVIEW</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>

  </div>