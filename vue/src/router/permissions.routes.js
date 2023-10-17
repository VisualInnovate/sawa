// permissions

const Index = () => import("@/views/permissions/Index.vue");
const Show = () => import("@/views/permissions/Show.vue");
const Edit = () => import("@/views/permissions/Edit.vue");
const Create = () => import("@/views/permissions/Create.vue");

const permissionsRoutes = [
  {
    path: "permissions",
    name: "Permissions",
    component: Index,
    meta: {
      permissions: ["permissions.index"],
    },
  },
  // create
  {
    path: "permissions/create",
    name: "CreatePermission",
    component: Create,
    meta: {
      permissions: ["permissions.create"],
    },
  },
  // show
  {
    path: "permissions/:id",
    name: "ShowPermission",
    component: Show,
    meta: {
      permissions: ["permissions.show"],
    },
  },
  // edit
  {
    path: "permissions/:id/edit",
    name: "EditPermission",
    component: Edit,
    meta: {
      permissions: ["permissions.edit"],
    },
  },
];

export default {
  ...permissionsRoutes,
};
