<%@ Page Title="Home Page" Language="C#" MasterPageFile="~/Site.Master" AutoEventWireup="true" CodeBehind="Default.aspx.cs" Inherits="CougarSearchWebsite._Default" %>

<asp:Content ID="BodyContent" ContentPlaceHolderID="MainContent" runat="server">
    <asp:TextBox ID="dogSearch" CssClass="form-control" runat="server"></asp:TextBox>
    <asp:Button ID="btnSearch" CssClass="btn btn-primary" runat="server" Text="Search" />
    <asp:GridView ID="gvDogs" runat="server" AutoGenerateColumns="false">
        <Columns>
            <asp:BoundField DataField="Name" HeaderText="Name" />
            <asp:BoundField DataField="Breed" HeaderText="Breed" />
            <asp:BoundField DataField="Age" HeaderText="Age" />
            <asp:BoundField DataField="Gender" HeaderText="Gender" />
            <asp:BoundField DataField="DatePosted" HeaderText="Date Posted" />
        </Columns>
        </asp:GridView>
    <asp:GridView ID="Dogs" runat="server"></asp:GridView>

</asp:Content>
