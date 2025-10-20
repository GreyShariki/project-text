import PageLoader from "./PageLoader.js";
import { AuthManager } from "./AuthManager.js";
import { DataManager } from "./DataManager.js";

(async (PageLoader, AuthManager, DataManager) => {
  const app = document.getElementById("app");
  const Loader = new PageLoader(app);
  const userAuth = new AuthManager();
  const dataController = new DataManager();

  const loadTimePage = async () => {
    await Loader.loadPage("Datetime");
    const response = await dataController.getData("User");
    const setSessionTime = () => {
      const sessionTime = Math.floor(Date.now() / 1000) - response.startTime;
      const minutesSessionTime = Math.floor(sessionTime / 60);
      const secondsSessionTime = sessionTime % 60;
      const hoursSessionTime = Math.floor(minutesSessionTime / 60);
      const formatSessionTime = `${hoursSessionTime}:${
        minutesSessionTime % 60
      }:${secondsSessionTime}`;
      dataController.putData(formatSessionTime, "clock");
    };
    setSessionTime();
    const interval = setInterval(setSessionTime, 1000);
    const btnBack = document.getElementById("back");
    btnBack.addEventListener("click", () => {
      loadProfile();
      clearInterval(interval);
    });
  };

  const loadProfile = async () => {
    const profile = await Loader.loadPage("Profile");
    if (profile.status == 401) {
      await loadLoginForm();
    } else {
      const btnLogout = document.getElementById("logout");
      const btnTime = document.getElementById("datetime");
      const response = await dataController.getData("User");
      dataController.putData(response.user, "username");
      btnTime.addEventListener("click", async () => {
        await loadTimePage();
      });
      btnLogout.addEventListener("click", async () => {
        const response = await userAuth.logout();
        if (response.status === "Успех") {
          await Loader.loadPage("LoginForm");
        }
      });
    }
  };

  const loadLoginForm = async () => {
    await Loader.loadPage("LoginForm");
    const form = document.getElementById("loginForm");
    form.addEventListener("submit", async (e) => {
      e.preventDefault();
      const response = await userAuth.authenticate(form);
      if (response.status === "Успех") {
        await loadProfile();
      }
    });
  };

  loadProfile();
})(PageLoader, AuthManager, DataManager);
