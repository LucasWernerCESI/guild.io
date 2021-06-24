import { SupportForm } from "./SupportForm";
import { Card, CardContent, Grid, makeStyles } from "@material-ui/core";
import { GuildCardTitle } from "../../Misc/GuildCardTitle";

const useStyles = makeStyles({
    supportGrid: {
        height: "100%"
    }
} );

export function Support () {

    const classes = useStyles();

    return (
        <Grid
            container
            spacing={2}
            alignContent={"center"}
            alignItems={"center"}
            justify={"center"}
            className={ classes.supportGrid }
        >

            <Grid item md={8} sm={10} xs={12}>

                <Card>
                    <CardContent>

                        <GuildCardTitle title={"demande de support"} />
                        <SupportForm />

                    </CardContent>


                </Card>

            </Grid>

        </Grid>
    )
}