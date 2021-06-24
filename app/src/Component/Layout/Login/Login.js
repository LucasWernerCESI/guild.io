import {
    Card,
    CardContent,
    Grid,
    makeStyles
} from "@material-ui/core";
import {useHistory} from "react-router-dom";
import {LoginForm} from "./LoginForm";
import {GuildCardTitle} from "../../Misc/GuildCardTitle";
import { AccessController } from "../../Controller/AccessController/AccessController";

const useStyles = makeStyles({
    loginGrid:{
        height: "100%"
    }
} );

export function Login () {

    AccessController();

    let history = useHistory();
    let storage = localStorage;

    const classes = useStyles();

    return (
        <Grid
            container
            spacing={2}
            alignContent={"center"}
            alignItems={"center"}
            justify={"center"}
            className={classes.loginGrid}
        >

            <Grid item md={6} sm={9} xs={12}>

                <Card>
                    <CardContent>

                        <GuildCardTitle title={"connexion"} />
                        <LoginForm />

                    </CardContent>


                </Card>

            </Grid>

        </Grid>
    )
}