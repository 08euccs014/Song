<style>
.inputbox
{
	height:auto !important;
	width:280px;
}

</style>

<form action="" method="post">

<table>
	<tr>
		<td>Title</td>
		<td><input type=text  class="inputbox" id="title" name=title placeholder="add ticket title"></td>
	</tr>
	<tr>
		<td>Description</td>
		<td><input type=text  class="inputbox" id="description" name=description placeholder="add description"></td>
	</tr>
	<tr>
		<td>Level</td>
		<td>
			<select id="level" class="inputbox" name=level placeholder="choose severity">
				<option value=0>low</option>
				<option value=1>normal</option>
				<option value=2>medium</option>
				<option value=3>high</option>
				<option value=4>highest</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Type</td>
		<td>
			<select id="type"  class="inputbox" name=type placeholder="choose type">
				<option value=0>normal</option>
				<option value=1>bug</option>
				<option value=2>feature</option>
				<option value=3>discuss</option>
				<option value=4>conflict</option>
				<option value=5>task</option>
				<option value=6>assignment</option>
				<option value=7>custom work</option>
			</select>		
		</td>
	</tr>
	<tr>
		<td>Deadline</td>
		<td><input id="deadline_date"  class="inputbox" type=date name=deadline_date placeholder="what's the deadline" value="<?php echo date("Y-m-d");?>"></td>
	</tr>
	<tr>
		<td>Release Date</td>
		<td><input id="release_date"  class="inputbox" type=date name=release_date placeholder="when i m release" value="<?php echo date("Y-m-d");?>"></td>
	</tr>
	<tr>
		<td>Milestone</td>
		<td>
			<select id="milestone"  class="inputbox" name=milestone placeholder="choose version">
				<option value=3.0>3.0</option>
				<option value=2.4>2.4</option>
				<option value=2.3>2.3</option>
				<option value=2.2>2.2</option>
			</select>		
		</td>
	</tr>
</table>

</form>