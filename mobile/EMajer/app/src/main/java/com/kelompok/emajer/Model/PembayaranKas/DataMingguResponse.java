package com.kelompok.emajer.Model.PembayaranKas;

import java.util.List;

public class DataMingguResponse {

    private int status;
    private String message;
    private List<DataMinggu> data;

    public int getStatus() {
        return status;
    }

    public void setStatus(int status) {
        this.status = status;
    }

    public String getMessage() {
        return message;
    }

    public void setMessage(String message) {
        this.message = message;
    }

    public List<DataMinggu> getData() {
        return data;
    }

    public void setData(List<DataMinggu> data) {
        this.data = data;
    }
}
