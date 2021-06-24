import { AppBar, Container, Tab, Tabs } from "@material-ui/core";
import React from 'react';
import { useHistory } from "react-router-dom";
import { GuildAccountIcon } from "../GuildAccountIcon/GuildAccountIcon";
import { makeStyles } from "@material-ui/styles";

const useStyles = makeStyles( theme => ( {
    appBar: {
        marginBottom: theme.spacing(2)
    },
    navContainer: {
        display: "grid",
        gridTemplateColumns: "1fr .25fr"
    },
    tabsGroup: {
        width: "auto"
    }
} ) );

export function GuildNavBar ( { pageList } ) {

    const classes = useStyles();

    const [value, setValue] = React.useState(0);
    let history = useHistory();

    // Changes the active tab and route
    const handleChange = ( ev, newVal ) => {
        setValue(newVal);
        history.push( pageList[newVal] !== "home" ? '/' + pageList[newVal] : '/' );
    };

    // Generates as many nav tabs as we have entries in pageList
    let tabList = pageList.map( ( el ) => <Tab key={ el.toLowerCase() + "_nav" } label={ el.toLowerCase() } /> );

    return (
        <AppBar position="static" className={ classes.appBar }>
            <Container className={ classes.navContainer }>
                <Tabs className={ classes.navContainer } indicatorColor={"secondary"} value={value} onChange={handleChange} aria-label="navigation tabs">
                    { tabList }
                </Tabs>
                <GuildAccountIcon/>
            </Container>
        </AppBar>
    )
}