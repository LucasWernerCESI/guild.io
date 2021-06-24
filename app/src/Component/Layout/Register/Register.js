import {
    Card,
    CardContent,
    Grid,
    makeStyles
} from "@material-ui/core";
import {useHistory} from "react-router-dom";
import {RegisterForm} from "./RegisterForm";
import {GuildCardTitle} from "../../Misc/GuildCardTitle";
import {AccessController} from "../../Controller/AccessController/AccessController";

const useStyles = makeStyles({
    registerGrid: {
        height: "100%"
    }
} );

export function Register () {

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
            className={ classes.registerGrid }
        >

            <Grid item md={6} sm={9} xs={12}>

                <Card>
                    <CardContent>

                        <GuildCardTitle title={"nouveau compte"} />
                        <RegisterForm />

                    </CardContent>


                </Card>

            </Grid>

        </Grid>
    )
}