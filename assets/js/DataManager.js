export class DataManager {
  async getData(dataname) {
    try {
      const response = await fetch(`index.php?action=get${dataname}`);
      const data = await response.json();
      return data;
    } catch (error) {
      console.error(error);
    }
  }
  putData(data, elementId) {
    const element = document.getElementById(elementId);
    element.innerHTML = data;
  }
}
