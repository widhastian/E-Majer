package com.pina.emajer_v2.Model;

import com.pina.emajer_v2.Model.DataModel;

import java.util.List;

public class ResponseModel {
    private int kode;
    private String pesan;
    private List<DataModel> data;

    public int getKode() {
        return kode;
    }

    public void setKode(int kode) {
        this.kode = kode;
    }

    public String getPesan() {
        return pesan;
    }

    public void setPesan(String pesan) {
        this.pesan = pesan;
    }

    public List<DataModel> getData() {
        return data;
    }

    public void setData(List<DataModel> data) {
        this.data = data;
    }
}
