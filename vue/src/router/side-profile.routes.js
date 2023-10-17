
const Index = () => import("../views/SideProfile/Index.vue");
const Show = () => import("../views/SideProfile/Show.vue");
const Edit = () => import("../views/SideProfile/Edit.vue");
const Create = () => import("../views/SideProfile/Create.vue");

const sideProfilesRoutes = [
    {
        path: "side-profiles",
        name: "SideProfiles",
        component: Index,
    },
    // create
    {
        path: "side-profiles/create",
        name: "CreateSideProfiles",
        component: Create,
    },
    // show
    {
        path: "side-profiles/:id",
        name: "ShowSideProfiles",
        component: Show,
    },
    // edit
    {
        path: "side-profiles/:id/edit",
        name: "EditSideProfiles",
        component: Edit,
    },
];

export default {
    ...sideProfilesRoutes,


};
