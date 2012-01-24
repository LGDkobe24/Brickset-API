<?php

//$brickset_display = new BricksetAPIDisplay();

class BricksetAPIDisplay extends BricksetAPIFunctions
{
	/** 
	 *	Display a list of all themes
	 *
	 *	Brickset returns the following fields in an array
	 *	themeData
	 *		theme 		- string
	 *		setCount 	- int
	 *
	 *	@author		Nate Jacobs
	 *	@since		0.1
	 */
	public function list_themes()
	{
		parent::get_themes();
		try
		{
			if ( $this->httpcode != 200 )
				throw new Exception ( $this->error_msg );

			foreach ( $this->results as $theme )
			{
				echo $theme->theme.'<br>';
			}
		}
		catch ( Exception $e ) 
		{
			echo $e->getMessage();
		}	
	}
	
	/** 
	 *	Display a list of all subthemes for a given theme
	 *
	 *	Brickset returns the following fields in an array
	 *	subthemeData
	 *		theme		- string
	 *		subtheme	- string
	 *		setCount	- int
	 *		yearFrom	- int
	 *		yearTo		- int
	 *
	 *	@author		Nate Jacobs
	 *	@since		0.1
	 */
	public function list_subthemes( $theme )
	{
		parent::get_subthemes( $theme );
		
		try
		{
			if ( $this->httpcode != 200 )
				throw new Exception ( $this->error_msg ); 

			echo '<h2>'.$this->results->subthemeData->theme.'</h2>';
			echo '<table><th>Subtheme</th><th>Set Count</th><th>Start Year</th><th>End Year</th>';		
			foreach ( $this->results as $subtheme )
			{
				echo '<tr>';
					echo '<td>'.$subtheme->subtheme.'</td>'; 
					echo '<td>'.$subtheme->setCount.'</td>';
					echo '<td>'.$subtheme->yearFrom.'</td>';
					echo '<td>'.$subtheme->yearTo.'</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		catch ( Exception $e ) 
		{
			echo $e->getMessage();
		}
	}

	/** 
	 *	Display a list of years a theme was available
	 *
	 *	Brickset returns the following fields in an array
	 *	yearData
	 *		theme		- string
	 *		year		- string
	 *		setCount	- int
	 *
	 *	@author		Nate Jacobs
	 *	@since		0.1
	 */
	public function list_years( $theme )
	{
		parent::get_years( $theme );
		
		try
		{
			if ( $this->httpcode != 200 )
				throw new Exception ( $this->error_msg );

			echo '<h2>'.$this->results->yearData->theme.'</h2>';
			echo '<table><th>Year</th><th>Set Count</th>';			
			foreach ( $this->results as $year )
			{
					echo '<tr>';
						echo '<td>'.$year->year.'</td>';
						echo '<td>'.$year->setCount.'</td>';		
					echo '</tr>';
			}
			echo '</table>';
		}
		catch ( Exception $e ) 
		{
			echo $e->getMessage();
		}
	}
	
	/** 
	 *	Display a list of the most searched for terms
	 *
	 *	Brickset returns the following fields in an array
	 *	searchData
	 *		searchTerm	- string
	 *		count		- int
	 *
	 *	@author		Nate Jacobs
	 *	@since		0.1
	 */
	public function list_searches()
	{
		parent::get_searches();
		
		try
		{
			if ( $this->httpcode != 200 )
				throw new Exception ( $this->error_msg );
			
			echo '<table><th>Search Term</th><th>Weight of Search</th>';	
			foreach ( $this->results as $search )
			{
				echo '<tr>';
					echo '<td>'.$search->searchTerm.'</td>';
					echo '<td>'.$search->count.'</td>';		
				echo '</tr>';
			}
			echo '</table>';
		}
		catch ( Exception $e ) 
		{
			echo $e->getMessage();
		}
	}
	
	/** 
	 *	Display a list of all sets updated since a given date
	 *
	 *	Brickset returns the following fields in an array
	 *	setData
	 *		setID			- int
	 *		number			- string
	 *		numberVariant 	- int
	 *		setName			- string
	 *		year			- string
	 *		theme			- string
	 *		subtheme		- string
	 *		pieces			- string
	 *		thumbnailURL	- string
	 *		imageUrl		- string
	 *		bricksetURL		- string
	 *		own				- boolean
	 *		want			- boolean
	 *		qtyOwned		- int
	 *		lastUpdated		- dateTime
	 *
	 *	@author		Nate Jacobs
	 *	@since		0.1
	 */	
	public function updated_since( $date )
	{
		parent::get_updated( $date );
		
		try
		{
			if ( $this->httpcode != 200 )
				throw new Exception ( $this->error_msg );
			
			echo '<table><th>Image</th><th>Set Name</th><th>Set Number</th>';	
			foreach ( $this->results as $updated )
			{
				echo '<tr>';
					echo '<td><img src="'.$updated->thumbnailURL.'"></td>';
					echo '<td>'.$updated->setName.'</td>';
					echo '<td>'.$updated->number.'</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		catch ( Exception $e ) 
		{
			echo $e->getMessage();
		}
	}
}