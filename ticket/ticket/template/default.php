<a href="#myModal" role="button" class="btn" data-toggle="modal">Create Ticket</a>

<table class="table table-striped table-bordered table-hover">
<tr class="info">
	<td>Title</td>
	<td>Description</td>
	<td>Type</td>
	<td>Level</td>
	<td>created_date</td>
	<td>deadline_date</td>
	<td>release_date</td>
	<td>milestone</td>
	<td>committed</td>
	<td>remark</td>
	<td>status</td>
</tr>
<?php foreach ($this->records as $record): ?>
<tr>
	<td><textarea class="change titlebox" rows="5" cols="250" name=title id=<?php echo $record->id;?> ><?php echo $record->title; ?></textarea></td>
	<td><textarea class="change descbox" rows="5" cols="250" name=description id=<?php echo $record->id;?> ><?php echo $record->description; ?></textarea></td>
	<td>		
		<select id=<?php echo $record->id;?>  class="change typeselectbox" name=type placeholder="choose type">
			<option <?php if ($record->type == 0 ) echo 'selected'; ?> value=0>normal</option>
			<option <?php if ($record->type == 1 ) echo 'selected'; ?> value=1>bug</option>
			<option <?php if ($record->type == 2 ) echo 'selected'; ?> value=2>feature</option>
			<option <?php if ($record->type == 3 ) echo 'selected'; ?> value=3>discuss</option>
			<option <?php if ($record->type == 4 ) echo 'selected'; ?> value=4>conflict</option>
			<option <?php if ($record->type == 4 ) echo 'selected'; ?> value=5>task</option>			
			<option <?php if ($record->type == 4 ) echo 'selected'; ?> value=6>assignment</option>			
			<option <?php if ($record->type == 4 ) echo 'selected'; ?> value=7>custom work</option>			
		</select>
	</td>
	<td>
		<select id=<?php echo $record->id;?>  class="change levelselectbox" name=level placeholder="choose severity">
			<option <?php if ($record->level == 0 ) echo 'selected'; ?> value=0>0</option>
			<option <?php if ($record->level == 1 ) echo 'selected'; ?> value=1>1</option>
			<option <?php if ($record->level == 2 ) echo 'selected'; ?> value=2>2</option>
			<option <?php if ($record->level == 3 ) echo 'selected'; ?> value=3>3</option>
			<option <?php if ($record->level == 4 ) echo 'selected'; ?> value=4>4</option>
		</select>
	</td>
	<td><?php echo $record->created_date; ?></td>
	<td><?php echo $record->deadline_date; ?></td>
	<td><?php echo $record->release_date; ?></td>
	<td>
		<select id=<?php echo $record->id;?>  class="change levelselectbox" name=milestone placeholder="choose milestone">
			<option <?php if ($record->milestone == 3.0 ) echo 'selected'; ?> value=3.0>3.0</option>
			<option <?php if ($record->milestone == 2.4 ) echo 'selected'; ?> value=2.4>2.4</option>
			<option <?php if ($record->milestone == 2.3 ) echo 'selected'; ?> value=2.3>2.3</option>
			<option <?php if ($record->milestone == 2.2 ) echo 'selected'; ?> value=2.2>2.2</option>
		</select>	
	</td>
	<td>
		<div>
		 <?php if($record->committed): ?>
		 <label class="change btn active btn-success">Committed</label>
		 <?php else: ?> 
		 <label class="change btn active btn-danger">Not Committed</label>
		 <?php endif;?>
		</div>
		<div>
			yes <input type=radio name="committed<?php echo $record->id;?>" value=1 class="change btn " id="<?php echo $record->id;?>"   <?php if ($record->committed == 1 ) echo 'checked'; ?> />
		 	no  <input type=radio  name="committed<?php echo $record->id;?>" value=0 class="change btn " id="<?php echo $record->id;?>"   <?php if ($record->committed == 0 ) echo 'checked'; ?> />
		</div>
	</td>
	<td><textarea class="change remarkbox" rows="5" cols="250" name=remark id=<?php echo $record->id;?>  ><?php echo $record->remark; ?></textarea></td>
	<td>
		<select id=<?php echo $record->id;?>  class="change statusselectbox" name=status placeholder="choose status">
			<option <?php if ($record->status == 0 ) echo 'selected'; ?> value=0>Not-started yet</option>
			<option <?php if ($record->status == 1 ) echo 'selected'; ?> value=1>What to do with it</option>
			<option <?php if ($record->status == 2 ) echo 'selected'; ?> value=2>Discuss</option>
			<option <?php if ($record->status == 3 ) echo 'selected'; ?> value=3>Not interested</option>
			<option <?php if ($record->status == 4 ) echo 'selected'; ?> value=4>Working</option>
			<option <?php if ($record->status == 5 ) echo 'selected'; ?> value=5>done but not commited</option>
			<option <?php if ($record->status == 6 ) echo 'selected'; ?> value=6>forgot</option>
			<option <?php if ($record->status == 7 ) echo 'selected'; ?> value=7>done</option>
		</select>		
	</td>
	<td>
		<a href="#" class="btn btn-danger" onclick="deleteTicket(<?php echo $record->id;?>);"><i class="icon-trash"></i>Delete</a>
	</td>
	
</tr>
<?php endforeach;?>
</table>
 
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
<h3 id="myModalLabel">Create New Ticket</h3>
</div>
<div class="modal-body">
<p>
<?php include_once (dirname(__FILE__)."/ticketform.php");?>
</p>
</div>
<div class="modal-footer">
<button onclick="createTicket();" data-dismiss="modal" aria-hidden="true" class="btn btn-primary">DONE</button>
</div>
</div>