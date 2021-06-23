import { AppBar, Container, Tab, Tabs } from "@material-ui/core";
import React from 'react';
import "./GuildNavBar.css";
import { useHistory } from "react-router-dom";
import { GuildAccountIcon } from "../GuildAccountIcon/GuildAccountIcon";

export function GuildNavBar ( { pageList } ) {

    const [value, setValue] = React.useState(0);
    let history = useHistory();

    // Changes the active tab and route
    const handleChange = ( ev, newVal ) => {
        setValue(newVal);
        history.push( pageList[newVal] !== "home" ? pageList[newVal] : '' );
    };

    // Generates as many nav tabs as we have entries in pageList
    let tabList = pageList.map( ( el ) => <Tab key={ el.toLowerCase() + "_nav" } label={ el.toLowerCase() } /> );

    return (
        <AppBar position="static" className={"app-bar"}>
            <Container className={"nav-container"}>
                <Tabs className={"tabs-group"} indicatorColor="secondary" textColor="secondary" value={value} onChange={handleChange} aria-label="navigation tabs">
                    { tabList }
                </Tabs>
                <GuildAccountIcon/>
            </Container>
        </AppBar>
    )
}