import AccountCircleIcon from '@material-ui/icons/AccountCircle';
import React from "react";
import { Box, IconButton, Switch } from "@material-ui/core";
import './GuildAccountIcon.css';
import { useHistory } from "react-router-dom";

export function GuildAccountIcon () {

    const storage = localStorage;

    let history = useHistory();

    const [isLogged, setIsLogged] = React.useState(
        ( storage.getItem("isLogged") === "0" )
            ? false
            : true
    );

    const handleChange = ( ev, val ) => {
        console.log(storage);
        switch ( val ) {
            case true:
                break;

            case false:
                history.push( "home" );
                break;
        }
        storage.setItem( "isLogged", val === true ? "1" : "0" );
        setIsLogged( val );
    };

    const handleClick = ( ev ) => {
        history.push( "user" );
    };

    return (
        <Box className={ "account-box" }>
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