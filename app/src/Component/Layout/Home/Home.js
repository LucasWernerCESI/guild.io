import {AccessController} from "../../Controller/AccessController/AccessController";
import {Box, Card, CardContent, Divider, Grid, makeStyles } from "@material-ui/core";
import {GuildCardTitle} from "../../Misc/GuildCardTitle";
import AccountCircleIcon from "@material-ui/icons/AccountCircle";
import React from "react";

const useStyles = makeStyles(theme => ({
    fullHeight: {
        height: "100%",
        marginTop: 0,
        marginBottom: 0
    },
    newsHeader: {
        height: "30%"
    },
    guildList: {
        height: "70%"
    }
} ) );

export function Home () {

    AccessController();

    const classes = useStyles();

    return (
        <Grid
            container
            spacing={2}
            alignContent={"center"}
            alignItems={"center"}
            justify={"center"}
            className={ classes.fullHeight }
        >

            <Grid item md={12} sm={12} xs={12} className={ classes.newsHeader }>

                <Card
                    className={ classes.fullHeight }
                >
                    <CardContent
                        className={ classes.fullHeight }
                    >

                    </CardContent>


                </Card>

            </Grid>

            <Grid item md={12} sm={12} xs={12} className={ classes.guildList }>

                <Card
                    className={ classes.fullHeight }
                >
                    <CardContent
                        className={ classes.fullHeight }
                    >

                    </CardContent>


                </Card>

            </Grid>

        </Grid>
    )
}