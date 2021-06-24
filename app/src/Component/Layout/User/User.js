import {AccessController} from "../../Controller/AccessController/AccessController";
import {Box, Card, CardContent, Divider, Grid, makeStyles, Typography} from "@material-ui/core";
import {GuildCardTitle} from "../../Misc/GuildCardTitle";
import AccountCircleIcon from "@material-ui/icons/AccountCircle";
import React from "react";
import {UserInfoBox} from "./UserInfoBox";

const useStyles = makeStyles(theme => ({
    fullHeight: {
        height: "100%",
        marginTop: 0,
        marginBottom: 0
    },
    accountIcon: {
        width: "100%",
        height: "25%",
        fontSize: "45rem"
    },
    infoBox: {
        display: "flex",
        flexDirection: "column",
        gap: theme.spacing(2),
        marginTop: theme.spacing(2)
    }
} ) );

export function User () {

    AccessController();

    let user = JSON.parse( localStorage.getItem( "user" ) );

    const [hasCharacters, setHasCharacters] = React.useState()

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

            <Grid item md={3} sm={3} xs={12} className={ classes.fullHeight }>

                <Card
                    className={ classes.fullHeight }
                >
                    <CardContent
                        className={ classes.fullHeight }
                    >
                        <GuildCardTitle title={"compte"} />
                        <AccountCircleIcon className={classes.accountIcon} />

                        <Divider />

                        <Box className={ classes.infoBox }>
                            <UserInfoBox label={"Pseudo"} value={user.username} />
                            <UserInfoBox label={"Mail"} value={user.mail} />
                            <UserInfoBox label={"Anniversaire"} value={user.birthday} />
                            <UserInfoBox label={"Création du compte"} value={user.creationDate} />
                        </Box>


                    </CardContent>


                </Card>

            </Grid>

            <Grid item md={9} sm={9} xs={12} className={ classes.fullHeight }>

                <Card
                    className={ classes.fullHeight }
                >
                    <CardContent
                        className={ classes.fullHeight }
                    >

                        {

                        }

                    </CardContent>


                </Card>

            </Grid>

        </Grid>
    )
}