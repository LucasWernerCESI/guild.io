import AccountCircleIcon from '@material-ui/icons/AccountCircle';
import React from "react";
import { Box, IconButton, Switch } from "@material-ui/core";
import { useHistory } from "react-router-dom";
import { makeStyles } from "@material-ui/styles";

const useStyles = makeStyles( {
    accountBox: {
        display: "flex",
        flexDirection: "row",
        flexWrap: "nowrap",
        alignItems: "center",
        justifyContent: "flex-end"
    }
} )

export function GuildAccountIcon () {

    const classes = useStyles();

    const storage = localStorage;

    let history = useHistory();

    const [isLogged, setIsLogged] = React.useState(
        ( storage.getItem( "isLogged" ) === "0" )
            ? false
            : true
    );

    const handleChange = ( ev, val ) => {
        console.log(storage);
        switch ( val ) {
            case true:
                history.push( "login" );
                break;

            case false:
                history.push( "" );
                storage.setItem( "isLogged", "0" );
                setIsLogged( false );
                break;
        }

    };

    const handleClick = ( ev ) => {
        history.push( "user" );
    };

    return (
        <Box className={ classes.accountBox }>
                {
                    isLogged &&
                    <IconButton onClick={ handleClick } aria-label="account">
                        <AccountCircleIcon fontSize={ "default" } color={ "secondary" } />
                    </IconButton>
                }
            <Switch value={ isLogged } checked={ isLogged } onChange={ handleChange }/>
        </Box>
    );

}