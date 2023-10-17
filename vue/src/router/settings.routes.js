const SiteSettings = () => import("@/views/site/Settings.vue");
const SitePages = () => import("@/views/site/Pages.vue");

const rolesRoutes = [
  {
    path: "settings",
    name: "settings",
    component: SiteSettings,
    meta: {
      permissions: ["roles.index"],
    },
  },
  {
    path: "pages",
    name: "pages",
    component: SitePages,
    meta: {
      permissions: ["roles.index"],
    },
  },
];

export default {
  ...rolesRoutes,
};
