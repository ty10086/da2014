<?php
// Convert all of the tables in the database to MyISAM.
$mysqli = new mysqli("localhost", "root", "", "mzd20140322");
// Check connection
if ( $mysqli->connect_errno ) {
    print( "Connect failed: " . $mysqli->connect_error );
    exit( );
}
// Get the resultset
if ( $result = $mysqli->query( "SHOW TABLES" ) ) {
    print("Number of tables: " . $result->num_rows . "<br />");
    // For each table, convert to ISAM.
    while( $row = $result->fetch_row() )
    {
        $table_name = $row[ 0 ];
        $mysqli->query( "ALTER TABLE " . $table_name . " ENGINE=MyISAM" );
        print( $table_name . " converted to MyISAM<br />" );
    }
    // Free result set
    $result->close( );
}
$mysqli->close( );
?>