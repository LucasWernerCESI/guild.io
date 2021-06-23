import {
    Card,
    CardActions,
    CardContent,
    CardHeader,
    Container, Divider,
    Grid,
    makeStyles,
    Paper,
    Typography
} from "@material-ui/core";
import {useHistory} from "react-router-dom";

const useStyles = makeStyles({
    loginGrid:{
        height: "100%"
    }
} );

export function Login () {

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
                        <Typography variant={"h6"} color={"primary"}>
                            CONNEXION
                        </Typography>
                        <Divider/>
                        LogIn Inputs
                    </CardContent>
                    <CardActions>

                    </CardActions>

                </Card>
            </Grid>

        </Grid>
    )
}