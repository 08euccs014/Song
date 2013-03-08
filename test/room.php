<?php
class room
{
	public $bedroom;
	public $kitchen;
	public $hall;
	public $rent;
	public $available;
	public $type;
	

	public function getAvailable()
	{
		return $this->available;
	}
}


class user
{
	public $name;
	public $pocket;
	
	public function getPocket()
	{
		return $this->pocket;
	}
	
	public function setPocket($amt = 0)
	{
		$this->pocket = $amt;
	}
	
}

class managment
{
	
	/* this mapping array should follow this rule
	 * user ---> room_no
	 * 		|--> room_type
	 * 		|--> no_of_room
	 *  
	 */
	public $mapping = array();
	
	//this will allocate which room to who user
	function allocateRoom(room $room,user $user)
	{
		$this->mapping[$user->name] = array($room->type,1);
	}
	
	function display()
	{
		?>
		<div>
			<tr>
				<td>Cutomer Name</td>
				<td>Room Type</td>
				<td>No of Rooms</td>	
			</tr>
		</div>
		
		<div>
		<?php foreach ($this->mapping as $key => $val):?>
			<tr>
				<td><?php echo $key; 	?></td>
				<td><?php echo $val[0]; ?></td>
				<td><?php echo $val[1]; ?></td>	
			</tr>
		<?php endforeach;?>
		</div>
		<?php 
	}
	
	public function allocate(room $room,user $user)
	{
		//if i can't allocate room tehn return false
		if($room->available == 0){
			return false;
		}
		
		//if yes then return true
		$userMoney = $user->getPocket();

		if($userMoney >= $room->rent){

			$this->allocateRoom($room, $user);
			$user->setPocket($userMoney-$room->rent);
			$room->available --;
			return true;
		}
		
		return false;
	} 
}


