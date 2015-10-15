<?php


class producttypeTable extends Doctrine_Table
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('producttype');
    }
    public static function fetch($id)
    {
      return Doctrine_Query::create()
        ->from('producttype f')
        ->where('f.id='.$id)
        ->fetchOne();
    }
    public static function followBreadCrumbsByNames($names,$separator=" ",$returnincomplete=false)
    {
			if(trim($names)=="")return;

    	$array=explode($separator, $names);
    	foreach($array as $index=>$name){$array[$index]=trim($name);}

			$producttypearray=array();

			//do first one (special treatment for root)
			$producttype=Fetcher::fetchOne("Producttype",array('name'=>'"'.$array[0].'"'));
			$producttypearray[]=$producttype;
			foreach($array as $index=>$name)
			{
				//skip first one
				if($index==0)continue;

				//one of the nodes not found
				if(!$producttype)
				{
					if($returnincomplete) 
						//return nodes found
						return $producttypearray;
					else 
						//return null
						return;
				}

				$parent_id=$producttype->getId();

		    $producttype= Doctrine_Query::create()
		      ->from('Producttype p')
		      ->where('p.name="'.$name.'"')
		      ->andWhere('p.parent_id="'.$parent_id.'"')
		      ->fetchOne();

				$producttypearray[]=$producttype;
 			}
			return $producttypearray;    	
    }
    
    public static function createOne($array)
    {
    	$producttype=new Producttype();
    	foreach($array as $key=>$value)
    		$producttype[$key]=$value;
    	$producttype->save();
			$producttype->calcPath();
    	return $producttype;
    }
    public static function cascadeCreate($names, $separator=" > ")
    {
    	$array=explode($separator,$names);
     	foreach($array as $index=>$name){$array[$index]=trim($name);}

			$producttypearray=array();

			//do first one (special treatment for root)
			$producttype=Fetcher::fetchOne("Producttype",array('name'=>'"'.$array[0].'"'));
			$parent_id=$producttype->getId();
			$producttypearray[]=$producttype;
			foreach($array as $index=>$name)
			{
				//skip first one
				if($index==0)continue;

				//fetch next producttype based on previous
		    $producttype= Doctrine_Query::create()
		      ->from('Producttype p')
		      ->where('p.name="'.$name.'"')
		      ->andWhere('p.parent_id="'.$parent_id.'"')
		      ->fetchOne();


				//one of the nodes not found
				//if null, create
				if(!$producttype)
				{
					//create
					$producttype=ProducttypeTable::createOne(array(
																											'name'=>$name,
																											'parent_id'=>$parent_id,
																											'priority'=>2,
																											));
				}

				//prepare for next round
				$parent_id=$producttype->getId();

				//add to array, whether fetched object or null
				$producttypearray[]=$producttype;
 			}
			return $producttypearray;    	
    	
    }
}
