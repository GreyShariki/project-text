import PageLoader from "./PageLoader.js";
import { AuthManager } from "./AuthManager.js";

(async (PageLoader, AuthManager) => {
  const app = document.getElementById("app");
  const Loader = new PageLoader(app);
  const userAuth = new AuthManager();

  const profile = await Loader.loadPage("Profile");
  if (profile.status == 401) {
    await Loader.loadPage("LoginForm");
    const form = document.getElementById("loginForm");
    form.addEventListener("submit", async (e) => {
      e.preventDefault();
      const response = await userAuth.authenticate(form);
      if (response.status === "Успех") {
        await Loader.loadPage("Profile");
        const btnLogout = document.getElementById("logout");
        const btnTime = document.getElementById("datetime");
        btnTime.addEventListener("click", async () => {
          await Loader.loadPage("Datetime");
        });
        btnLogout.addEventListener("click", async () => {
          const response = await userAuth.logout();
          if (response.status === "Успех") {
            await Loader.loadPage("LoginForm");
          }
        });
      }
    });
  } else {
    const btnLogout = document.getElementById("logout");
    btnLogout.addEventListener("click", async () => {
      const response = await userAuth.logout();
      if (response.status === "Успех") {
        await Loader.loadPage("LoginForm");
      }
    });
    const btnTime = document.getElementById("datetime");
    btnTime.addEventListener("click", async () => {
      await Loader.loadPage("Datetime");
    });
  }
})(PageLoader, AuthManager);
