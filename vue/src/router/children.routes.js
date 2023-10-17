// permissions

const Index = () => import("../views/children/Index.vue");
const Show = () => import("../views/children/Show.vue");
const Edit = () => import("../views/children/Edit.vue");
const Create = () => import("../views/children/Create.vue");
const evaluation = () => import("../views/children/ChildEvaluation.vue");
const result = () => import("../views/children/ChildResult.vue");
const editResult = () => import("../views/children/evaluationResultEdit.vue");
const res = () => import("../views/children/Resultr.vue");

const childrenRoutes = [
  {
    path: "children/:alert?",
    name: "Children",
    component: Index,
    meta: {
      permissions: ["child.index"],
    },
  },

  // create
  {
    path: "children/create",
    name: "CreateChildren",
    component: Create,
    meta: {
      permissions: ["child.create"],
    },
  },
  // show
  {
    path: "children/:id",
    name: "ShowChildren",
    component: Show,
    meta: {
      permissions: ["child.show"],
    },
  },
  // edit
  {
    path: "children/:id/edit",
    name: "EditChildren",
    component: Edit,
    meta: {
      permissions: ["child.update"],
    },
  },
  {
    path: "children/Resultr/:child_id/:sideProfile_id",
    name: "resulte",
    component: res,
    meta: {
      permissions: ["child.getChildAndSideProfile"],
    },
  },
  {
    path: "children/:child_id/:sideProfile_id",
    name: "showChildEvaluation",
    component: evaluation,
    meta: {
      permissions: ["child.getChildAndSideProfile"],
    },
  },
  {
    path: "children/:child_id/:sideProfile_id/:evaluation_id",
    name: "showChildResult",
    component: result,
    meta: {
      permissions: ["child.getChildAndSideProfile"],
    },
  },
  {
    path: "children/evaluation/:evaluation_result_id",
    name: "editChildResult",
    component: editResult,
    meta: {
      permissions: ["child.getChildAndSideProfile"],
    },
  },
];

export default {
  ...childrenRoutes,
};
