package com.kelompok.emajer.Model.Mading;

import java.util.List;

public class MadingResponse {
    String message;
    List<MadingData>  data;

    public String getMessage() {
        return message;
    }

    public void setMessage(String message) {
        this.message = message;
    }

    public List<MadingData> getData() {
        return data;
    }

    public void setData(List<MadingData> data) {
        this.data = data;
    }
}
