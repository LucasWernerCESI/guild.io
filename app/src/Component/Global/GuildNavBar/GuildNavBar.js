import {AppBar, Button, Container, IconButton, Tab, Tabs, Toolbar, Typography} from "@material-ui/core";
import React from 'react';
import { Link } from "react-router-dom";

export function GuildNavBar ( ) {

    const [value, setValue] = React.useState(0);

    const handleChange = (event, newValue) => {
        setValue(newValue);
    };

    return (
        <AppBar position="static">
            <Container>
                <Tabs indicatorColor="secondary" textColor="secondary" value={value} onChange={handleChange} aria-label="tabs as navigation">
                    <Tab label={
                        <Link to={"/"}>Home</Link>
                    } />

                    <Tab label={
                        <Link to={"/guild"}>Guild</Link>
                    } />

                    <Link to={"/support"}>
                        <Tab label="Support"/>
                    </Link>

                </Tabs>
            </Container>
        </AppBar>
    )
}