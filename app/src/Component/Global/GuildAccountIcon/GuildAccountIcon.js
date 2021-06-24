import AccountCircleIcon from '@material-ui/icons/AccountCircle';
import React from "react";
import { Box, IconButton, Switch } from "@material-ui/core";
import { useHistory } from "react-router-dom";
import { makeStyles } from "@material-ui/styles";
import {log10} from "chart.js/helpers";

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
    const user = JSON.parse( storage.getItem( "user" ) );

    let history = useHistory();

    const handleChange = ( ev, val ) => {
        switch ( val ) {
            case true:
                history.push( "/login" );
                break;

            case false:
                storage.setItem( "user", null );
                window.location = '/login';
                break;
        }

    };

    const handleClick = ( ev ) => {
        history.push( "/user" );
    };

    return (
        <Box className={ classes.accountBox }>
                { user.isLogged &&
                    <IconButton onClick={ handleClick } aria-label="account">
                        <AccountCircleIcon fontSize={ "default" } color={ "secondary" } />
                    </IconButton>
                }
            <Switch value={ user.isLogged } checked={ user.isLogged } onChange={ handleChange }/>
        </Box>
    );

}